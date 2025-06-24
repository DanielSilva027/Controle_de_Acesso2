from conexao import criar_conexao, fechar_conexao


def push_notificacao(id, nome, data_hora, dispositivo, face):
    con = criar_conexao()
    cursor = con.cursor()

    sql = "INSERT INTO notificacao (id_user, nome, data_hora, dispositivo, face) VALUES (%s, %s, %s, %s, %s)"
    valores = (id, nome, data_hora, dispositivo, face)

    cursor.execute(sql, valores)
    con.commit()
    cursor.close()
    fechar_conexao(con)

def pull_user(nome_img):
    con = criar_conexao()
    cursor = con.cursor()

    sql = "SELECT id, nome FROM user WHERE face = %s"
    valores = (nome_img,) 

    cursor.execute(sql, valores)
    resultado = cursor.fetchone()  # Pega o primeiro resultado

    cursor.close()
    fechar_conexao(con)

    if resultado:
        id, nome = resultado
        return id, nome
    else:
        return None, None  # Retorna valores padrão se não encontrar


