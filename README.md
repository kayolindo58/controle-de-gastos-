# controle-de-gastos-
um controle de gastos no terminal que guarda as informações que você pôr 

Aplicação de terminal feita em **PHP** para acompanhar o dinheiro guardado, os gastos do mês e o progresso até uma meta financeira.

Na primeira execução o programa pergunta seus dados iniciais e, a partir daí, tudo fica salvo automaticamente em um arquivo JSON local.

## ✨ Funcionalidades

- Cadastro inicial: valor guardado, valor gasto, objetivo e valor da meta
- Resumo financeiro com:
  - objetivo e meta
  - quanto já está guardado
  - quanto já foi gasto
  - quanto falta para atingir a meta
  - porcentagem de conclusão do objetivo
- Registro de novos valores guardados
- Registro de novos gastos
- Persistência automática dos dados em `dados.json`
- Validação básica: valores menores ou iguais a zero são recusados
- Valores exibidos no formato monetário brasileiro (ex.: `R$1.250,50`)

## 📋 Requisitos

- PHP 7.0 ou superior, executado via linha de comando (CLI)
- Extensão `readline` do PHP habilitada

Para conferir sua instalação:

```bash
php -v
php -m | grep readline
```

## 🚀 Como executar

1. Clone o repositório:

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
```

2. Execute o programa:

```bash
php index.php
```

## 🧭 Como usar

### Primeira execução

Se o arquivo `dados.json` ainda não existir, será exibida a tela inicial pedindo:

1. Valor guardado
2. Valor gasto
3. Seu objetivo (ex.: "Viagem", "Comprar um notebook")
4. Valor da meta

Os dados informados são salvos no `dados.json`.

### Menu principal

```
------ CONTROLE DE GASTOS ------
1. Consultar resumo financeiro
2. Registrar dinheiro guardado
3. Registrar gasto do mês
4. Sair
```

| Opção | Descrição |
|-------|-----------|
| 1 | Mostra o resumo financeiro completo e o progresso da meta |
| 2 | Soma um novo valor ao total guardado |
| 3 | Soma um novo gasto ao total gasto |
| 4 | Encerra o programa |

### Exemplo de resumo

```
--- RESUMO FINANCEIRO ---
Seu objetivo: Viagem
Sua meta: R$5.000,00
Quanto está guardado: R$1.250,00
Quanto foi gasto até agora: R$800,00
Quanto falta para atingir a meta: R$3.750,00
Seu objetivo está a 25% concluído.
```

## 🗂️ Estrutura do projeto

```
.
├── index.php     # Código principal da aplicação
└── dados.json    # Gerado automaticamente na primeira execução
```

### Formato do `dados.json`

```json
{
    "guardado": 1250,
    "gasto": 800,
    "objetivo": "Viagem",
    "metaTotal": 5000
}
```

> 💡 Para recomeçar do zero (novo objetivo e novos valores), basta apagar o arquivo `dados.json` e executar o programa novamente.

## 🛠️ Tecnologias

- [PHP](https://www.php.net/) (CLI)
- JSON para armazenamento local
