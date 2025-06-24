from conexao import criar_conexao, fechar_conexao

def test(con,localizacao,nome,n_de_serie):
    cursor = con.cursor()
    sql = "INSERT INTO dispositivo(localizacao,nome,n_de_serie ) values(%s,%s,%s)"
    valores =(localizacao,nome,n_de_serie)
    cursor.execute(sql,valores)
    cursor.close()
    con.commit()
    

def consulta():

    con =  criar_conexao()
  

    test(con,"sala","celula",1)


    fechar_conexao(con)


