# reconhecimento.py
import cv2
import face_recognition
import os
import numpy as np
import contrução_area


def carregar_codificacoes(pasta):
    codificacoes = []
    nomes = []
    for arquivo in os.listdir(pasta):
            nome = arquivo.split('.')[0]
            codificacao = np.load(os.path.join(pasta, arquivo))
            codificacoes.append(codificacao)
            nomes.append(nome)
    return codificacoes, nomes

encodings_conhecidos, nomes_classes = carregar_codificacoes(contrução_area.PASTA_CODIFICACOES)
print(f"Classes carregadas: {nomes_classes}")

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
            name = nomes_classes[idx].upper()

        y1, x2, y2, x1 = face_location
        cv2.rectangle(frame, (x1, y1), (x2, y2), (0, 255, 0), 2)
        cv2.rectangle(frame, (x1, y2 - 20), (x2, y2), (0, 255, 0), cv2.FILLED)
        cv2.putText(frame, name, (x1 + 6, y2 - 6), cv2.FONT_HERSHEY_DUPLEX, 0.6, (255, 255, 255), 1)

    cv2.imshow("Reconhecimento Facial - Pressione 'q' para sair", frame)

    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

cap.release()
cv2.destroyAllWindows()
