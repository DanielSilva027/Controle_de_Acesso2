# reconhecimento.py
import cv2
import face_recognition
import os
import numpy as np
import contrução_area
import consultas_banco
from datetime import datetime
from collections import defaultdict
import time

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

# Carrega os rostos conhecidos
encodings_conhecidos, nomes_classes = carregar_codificacoes(contrução_area.PASTA_CODIFICACOES)

# Controle para evitar registros duplicados em segundos
ultimos_registros = defaultdict(float)
INTERVALO_REGISTRO = 5  # segundos

# Inicializa a câmera
cap = cv2.VideoCapture(0)

while True:
    sucesso, frame = cap.read()
    if not sucesso:
        print("Falha ao capturar o quadro")
        break

    rgb_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
    face_locations = face_recognition.face_locations(rgb_frame)
    face_encodings = face_recognition.face_encodings(rgb_frame, face_locations)

    for face_encoding, face_location in zip(face_encodings, face_locations):
        matches = face_recognition.compare_faces(encodings_conhecidos, face_encoding, tolerance=0.6)
        name = "Desconhecido"

        if True in matches:
            idx = matches.index(True)
            name = nomes_classes[idx]

            tempo_atual = time.time()
            if tempo_atual - ultimos_registros[name] > INTERVALO_REGISTRO:
                id_user, nome_user = consultas_banco.pull_user(name)
                print(id_user, nome_user)
                if id_user is not None and nome_user is not None:
                    print(f"[DEBUG] Registrando {nome_user} no banco...")
                    consultas_banco.push_notificacao(id_user, nome_user, hora_atual(), "webCam", name)
                    ultimos_registros[name] = tempo_atual

        # (opcional) desenhar o quadrado e nome na tela:
        y1, x2, y2, x1 = face_location
        cv2.rectangle(frame, (x1, y1), (x2, y2), (0, 255, 0), 2)
        cv2.rectangle(frame, (x1, y2 - 20), (x2, y2), (0, 255, 0), cv2.FILLED)
        cv2.putText(frame, name.upper(), (x1 + 6, y2 - 6),
                    cv2.FONT_HERSHEY_DUPLEX, 0.6, (255, 255, 255), 1)

    # Exibe o vídeo com rostos marcados
    cv2.imshow("Reconhecimento Facial - Pressione 'q' para sair", frame)

    # Fecha com tecla 'q'
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Libera a câmera e fecha janelas
cap.release()
cv2.destroyAllWindows()
