import time
import threading
import reconhecimento
import construcao_area

# Thread 1 – Executa o reconhecimento facial em tempo real
def rodar_reconhecimento():
    reconhecimento.executar_reconhecimento()

# Thread 2 – Verifica se há novas imagens e gera os .npy
def verificar_novos_usuarios(intervalo=60):
    print("[Monitoramento] Verificando novas imagens a cada", intervalo, "segundos...")
    while True:
        construcao_area.processar_novas_imagens()
        time.sleep(intervalo)

if __name__ == "__main__":
    t1 = threading.Thread(target=rodar_reconhecimento)
    t2 = threading.Thread(target=verificar_novos_usuarios)

    t1.start()
    t2.start()

    t1.join()
    t2.join()
