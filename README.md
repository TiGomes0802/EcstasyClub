# EcstasyClub

Projeto final TeSP Programação de Sistemas e Informação


Base de dados disponível já com dados (a base de dados apenas guarda o nome das fotos não a foto em si a foto fica guardada localmente)

admin -> user:gomes0802 pass:12345678

Este projeto é uma discoteca onde é possivel comprar pulseiras para eventos criandos no backend.

Só é possivel criar rp's, gestores de eventos e seguranças no backend.

## Web App
Backend (Gestor de eventos e admin):
- Criar/Ver/Alterar(CRUD):
  - Eventos,
  - Galerias de fotos de cada evento,
  - Tipo de eventos,
  - Bebidas,
  - Vip's,
  - Noticias,
  - Empregados,
  - Apenas alterar os dados da disco caso seja um admin logado,
- É possivel ver dados dos eventos, admin, gestores e rp's.

Frontend :
- Ver fotos dos eventos,
- Ver suas informações por exemplo faturas(PDF) de pulseiras adquiridas, caso seja um rp logado consegue ver a informação do número de pessoas que utilizaram o seu código,
- Ver eventos,
- Comprar pulseira normal ou VIP caso seja uma pulseira VIP consegue escolher bebidas,
- Caso seja rp consegue partilhar um link com o seu código.

## Mobile App
Mobile:
- Segurança:
  - Validar a pulseira usando um leitor de QRcode
- Outras roles:
  - Ver:
    - Faturas,
    - Noticas,
    - Pulseiras ativas(em formato QRcode), desativas e não usadas,
  - Comprar pulseira normal ou VIP.
  - Apagar pulseiras desativas e não usadas.
(uma pulseira é ativa quando é comprada, desativa quando é lida pelo leitor de QRcode e é não usada quando passa o dia do evento e a pulseira não é utilizada)
  
  
  
