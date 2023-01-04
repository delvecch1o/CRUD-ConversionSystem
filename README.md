# CRUD-ConversionSystem

O sistema consiste em um painel com controle de usuário para
conversões de números, sendo que todas as conversões realizadas
pelo usuários deverão ser salvas para consulta de histórico vide detalhes.

#### 1. Autenticação

- Cadastro (nome, email, senha);
- Login;
- Logout;
- (Opcional) Recuperação de senha;
- (Opcional) Histórico de senhas do usuário;
- (Opcional) Não permitindo reutilização de senha do usuário na recuperação;

#### 2. Conversão numéricas estáticas

- Conversão de graus celsius para fahrenheit e vice versa;
- Conversão de graus celsius para kelvin e vice versa;
- Conversão de graus kelvin para fahrenheit e vice versa;

#### 3. Conversões não estáticas

- Conversão de Real para Dólar e vice versa;
- Conversão de Real para Euro e vice versa;
- Conversão de Dólar para Euro e vice versa;

> [AwesomeAPI - Cotações e modedas](https://docs.awesomeapi.com.br/api-de-moedas)

#### (Opcional) 4. Conversão de números romanos;

- Criar um algoritmo de conversão de números da notação decimal para a notação romana (de 0 até 3999);
- Criar um algoritmo de conversão de números da notação romana para a notação decimal;

> A tela que o usuário vai cair quando fizer o
> login consistirá de um formulário com os campos e
> opções de conversões citadas acima e logo abaixo uma tabela com o histórico de conversões que ele já realizou contendo: unidade de origem, unidade do resultado, número de origem, número do resultado e a data;

### Observações:

- O sistema deve ter o backend e frontend em camadas separadas então caso julgue necessário crie 2 repositórios ou faça 2 forks desse repositório;
- Use as linguagens e padrões que se você se sinta mais à vontade;
- Não reutilize algoritmos disponíveis na Internet, salvo no caso frameworks;
- Incluir arquivo com instruções de como configurar e rodar o sistema;
- Será valorizado caso tenha configuração com Docker;