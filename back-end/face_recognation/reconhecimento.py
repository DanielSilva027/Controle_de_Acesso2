import cv2
import face_recognition
import os
import numpy as np
import construcao_area
import consultas_banco
from datetime import datetime

# Controle de rostos visíveis no momento
presentes_atualmente = set()

# Retorna a data/hora atual formatada
def hora_atual():
    agora = datetime.now()
    return agora.strftime("%Y-%m-%d %H:%M:%S")

# Carrega codificações salvas em arquivos .npy
def carregar_codificacoes(pasta):
    codificacoes = []
    nomes = []
    for arquivo in os.listdir(pasta):
        if arquivo.endswith(".npy"):
            nome = arquivo.split('.')[0]
            codificacao = np.load(os.path.join(pasta, arquivo))
            codificacoes.append(codificacao)
            nomes.append(nome)
    return codificacoes, nomes

# Função principal a ser chamada pelo main.py
def executar_reconhecimento():
    print("[Reconhecimento] Iniciando reconhecimento facial...")
    global encodings_conhecidos, nomes_classes
    encodings_conhecidos, nomes_classes = carregar_codificacoes(construcao_area.PASTA_CODIFICACOES)

    cap = cv2.VideoCapture(0)

    while True:
        sucesso, frame = cap.read()
        if not sucesso:
            print("[Erro] Falha ao capturar o quadro da câmera")
            break

        rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
        face_locations = face_recognition.face_locations(rgb_frame)
        face_encodings = face_recognition.face_encodings(rgb_frame, face_locations)

        nomes_detectados = set()

        for face_encoding, face_location in zip(face_encodings, face_locations):
            matches = face_recognition.compare_faces(encodings_conhecidos, face_encoding, tolerance=0.6)
            name = "Desconhecido"

            if True in matches:
                idx = matches.index(True)
                name = nomes_classes[idx].strip().lower()
                nomes_detectados.add(name)

                if name not in presentes_atualmente:
                    id_user, nome_user = consultas_banco.pull_user(name)
                    print(f"[Reconhecido] ID: {id_user}, Nome: {nome_user}")
                    if id_user is not None and nome_user is not None:
                        consultas_banco.push_notificacao(id_user, nome_user, hora_atual(), "webCam", name)
                        presentes_atualmente.add(name)
            else:
                # Apenas registra nome não reconhecido sem ID
                consultas_banco.push_notificacao(None, name, hora_atual(), "webCam", name)

        # Remove quem saiu do quadro
        for nome in list(presentes_atualmente):
            if nome not in nomes_detectados:
                presentes_atualmente.remove(nome)

        cv2.imshow("Reconhecimento Facial - Pressione 'q' para sair", frame)

        if cv2.waitKey(1) & 0xFF == ord('q'):
            break

    cap.release()
    cv2.destroyAllWindows()
    print("[Reconhecimento] Encerrado.")
