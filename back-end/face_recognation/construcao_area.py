import cv2
import os
import numpy as np
import face_recognition

# Caminhos das pastas (AJUSTE CONFORME NECESSÁRIO)
PASTA = r'C:\Users\user\Desktop\p.i\Controle_de_Acesso2\rostos'
PASTA_CODIFICACOES = r'C:\Users\user\Desktop\p.i\Controle_de_Acesso2\rostos_codificacoes'

# Verifica se a codificação já existe
def verf_existencia(nome, pasta_codificacoes):
    for arquivo in os.listdir(pasta_codificacoes):
        nome_codif = os.path.splitext(arquivo)[0]
        if nome == nome_codif:
            return False
    return True

# Função que processa novas imagens
def processar_novas_imagens():
    print("[PROCESSAMENTO] Verificando novas imagens para codificação...")

    for arquivo in os.listdir(PASTA):
        if arquivo.lower().endswith(('.jpg', '.jpeg', '.png')):
            caminho_img = os.path.join(PASTA, arquivo)
            nome_base = os.path.splitext(arquivo)[0]

            if not verf_existencia(nome_base, PASTA_CODIFICACOES):
                continue

            # Lê a imagem
            quadro = cv2.imread(caminho_img)
            if quadro is None:
                print(f"[ERRO] Não foi possível carregar a imagem: {arquivo}")
                continue

            # Converte para RGB
            quadro_rgb = cv2.cvtColor(quadro, cv2.COLOR_BGR2RGB)

            # Gera codificações
            codificacoes = face_recognition.face_encodings(quadro_rgb)

            if codificacoes:
                caminho_codificacao = os.path.join(PASTA_CODIFICACOES, f"{nome_base}.npy")
                np.save(caminho_codificacao, codificacoes[0])
                print(f"[SUCESSO] Codificação salva: {nome_base}.npy")
            else:
                print(f"[AVISO] Nenhum rosto detectado em: {arquivo}")
