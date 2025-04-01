#!/bin/bash

# Função para alterar permissões e dono da pasta storage
corrige_permissoes() {
    echo "Corrigindo permissões na pasta storage..."
    # Define as permissões adequadas; ajuste os valores conforme sua necessidade
    chmod -R 775 storage
    # Se necessário, ajuste o dono para o usuário web (ex.: www-data) ou mantenha o usuário atual
    # Exemplo: chown -R $USER:www-data storage
    echo "Permissões alteradas. Verifique se o problema foi resolvido."
}

echo "-----------------------------------------------------"
echo "Verificando a versão do PHP:"
php -v
php_version=$(php -r "echo PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION;")
echo "Versão detectada: $php_version"
if [[ $(echo "$php_version >= 8.1" | bc -l) -eq 1 ]]; then
    echo "ATENÇÃO: PHP $php_version pode apresentar depreciações que afetam o Laravel."
fi
echo "-----------------------------------------------------"

# Verificar se o arquivo .env existe
if [ -f ".env" ]; then
    echo "Arquivo .env encontrado."
else
    echo "ERRO: Arquivo .env não encontrado. Certifique-se de ter um arquivo .env configurado corretamente."
    exit 1
fi
echo "-----------------------------------------------------"

# Verificar possíveis valores inválidos no .env (exemplo: verificar se alguma variável que deveria ser um array está numérica)
echo "Verificando o arquivo .env para valores potencialmente incorretos..."
grep -E "LOG_CHANNEL|OUTRA_VARIAVEL_QUE_DEVERIA_SER_ARRAY" .env || echo "Nenhuma variável suspeita encontrada. Revise manualmente se necessário."
echo "-----------------------------------------------------"

# Verificar permissões na pasta de logs
echo "Verificando permissões na pasta storage/logs..."
if [ ! -d "storage/logs" ]; then
    echo "Pasta storage/logs não encontrada. Criando a pasta..."
    mkdir -p storage/logs
fi

LOG_FILE="storage/logs/laravel.log"

# Se o arquivo não existir, tente criá-lo
if [ ! -f "$LOG_FILE" ]; then
    echo "Arquivo laravel.log não existe. Criando o arquivo..."
    touch "$LOG_FILE"
fi

if [ -w "$LOG_FILE" ]; then
    echo "O arquivo $LOG_FILE possui permissão de escrita."
else
    echo "ERRO: O arquivo $LOG_FILE não tem permissão de escrita."
    read -p "Deseja tentar corrigir as permissões da pasta storage? [s/n]: " resp
    if [[ "$resp" == "s" || "$resp" == "S" ]]; then
        corrige_permissoes
    else
        echo "Por favor, corrija as permissões manualmente e execute o script novamente."
        exit 1
    f

