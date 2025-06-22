import cv2
import os
import numpy as np
import face_recognition


# Criar um diretório para armazenar imagens de treinamento se não existir
os.makedirs('rostos', exist_ok=True)

# Obter o nome da pessoa para a codificação
nome = input("Digite o nome: ")

# Inicializa a captura de vídeo
captura = cv2.VideoCapture(0)

while True:
    sucesso, quadro = captura.read()
    if not sucesso:
        print("Falha ao capturar o quadro")
        break

    cv2.imshow("Treinamento - pressione 'c' para capturar ou 'q' para sair", quadro)

    tecla = cv2.waitKey(1) & 0xFF

    # Captura o quadro quando pressionar 'c'
    if tecla == ord('c'):
        caminho_img = f'rostos/{nome}.jpg'
        cv2.imwrite(caminho_img, quadro)
        print(f"Imagem salva em: {caminho_img}")

        # Converte o quadro para RGB e gera codificações faciais
        quadro_rgb = cv2.cvtColor(quadro, cv2.COLOR_BGR2RGB)
        codificacoes = face_recognition.face_encodings(quadro_rgb)

        # Salva a codificação facial como um array numpy
        if codificacoes:
            np.save(f'rostos/{nome}_codificacao.npy', codificacoes[0])
            print(f"Codificação salva para {nome}")
        else:
            print("Nenhum rosto detectado. Tente novamente.")

    # Sai do loop quando pressionar 'q'
    if tecla == ord('q'):
        break

# Libera o vídeo capturado e fecha as janelas
captura.release()
cv2.destroyAllWindows()