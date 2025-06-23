import cv2
import os
import numpy as np
import face_recognition
from PIL import Image

PASTA =  r'C:\Users\user\Desktop\p.i\Controle_de_Acesso2\rostos'
PASTA_CODIFICACOES = r'C:\Users\user\Desktop\p.i\Controle_de_Acesso2\rostos_codificacoes'


def verf_existencia(nome,pasta_codificacoes):
    resp = True
    for arquivo in os.listdir(pasta_codificacoes):
        nome_codif = os.path.splitext(arquivo)[0]
        if(nome == nome_codif):
            resp = False
            break

    return resp



# Criar um diretório para armazenar imagens de treinamento se não existir
os.makedirs('rostos', exist_ok=True)
os.makedirs('rostos_codificacoes', exist_ok=True)   


# Lista todos os arquivos da pasta
for arquivo in os.listdir(PASTA):
    if arquivo.lower().endswith(('.jpg', '.jpeg', '.png')):
        caminho_img = os.path.join(PASTA, arquivo)
        nome_base = os.path.splitext(arquivo)[0] 

        if(verf_existencia(nome_base,PASTA_CODIFICACOES) == False):
            continue
 
        # Lê a imagem
        quadro = cv2.imread(caminho_img)
        if quadro is None:
            print(f"Erro ao carregar: {arquivo}")
            continue

        quadro_rgb = cv2.cvtColor(quadro, cv2.COLOR_BGR2RGB)

        codificacoes = face_recognition.face_encodings(quadro_rgb)

        if codificacoes:
            caminho_codificacao = os.path.join(PASTA_CODIFICACOES, f"{nome_base}.npy")
            np.save(caminho_codificacao, codificacoes[0])