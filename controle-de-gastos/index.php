<?php

function limparTerminal()
{
    echo "\033[2J\033[;H";
}

$arquivo = __DIR__ . '/dados.json';
$dados = [];
$guardado = 0.0;
$gasto = 0.0;
$objetivo = '';
$metaTotal = 0.0;

if (file_exists($arquivo)) {
    $conteudo = file_get_contents($arquivo);
    $dados = json_decode($conteudo, true) ?? [];
}

if (!empty($dados)) {
    $guardado = (float) ($dados['guardado'] ?? 0.0);
    $gasto = (float) ($dados['gasto'] ?? 0.0);
    $objetivo = (string) ($dados['objetivo'] ?? '');
    $metaTotal = (float) ($dados['metaTotal'] ?? 0.0);
} else {
    limparTerminal();
    echo "--- PAGINA INICIAL ---\n";
    $guardado = (float) readline("Digite o valor guardado: ");
    $gasto = (float) readline("Digite o valor gasto: ");
    $objetivo = readline("digite qual seu objetivo: ");
    $metaTotal = (float) readline("Digite o valor da meta: ");

    $dados['guardado'] = $guardado;
    $dados['gasto'] = $gasto;
    $dados['objetivo'] = $objetivo;
    $dados['metaTotal'] = $metaTotal;

    file_put_contents($arquivo, json_encode($dados, JSON_PRETTY_PRINT));
}

$salvarDadosAtuais = function () use ($arquivo, &$dados, &$guardado, &$gasto, &$objetivo, &$metaTotal) {
    $dados['guardado'] = $guardado;
    $dados['gasto'] = $gasto;
    $dados['objetivo'] = $objetivo;
    $dados['metaTotal'] = $metaTotal;
    file_put_contents($arquivo, json_encode($dados, JSON_PRETTY_PRINT));
};



$executando = true;

while ($executando) {
    $atingirmeta = $metaTotal - $guardado;
    $porcentagem = ($metaTotal > 0) ? ($guardado / $metaTotal) * 100 : 0;

    echo "\n------ CONTROLE DE GASTOS ------\n";
    echo "1. Consultar resumo financeiro \n";
    echo "2. Registrar dinheiro guardado \n";
    echo "3. Registrar gasto do mês \n";
    echo "4. Sair \n";

    switch (readline("Escolha uma opção: ")) {
        case 1:
            limparTerminal();
            echo "--- RESUMO FINANCEIRO ---\n";
            echo "Seu objetivo: " . $objetivo . "\n";
            echo "Sua meta: R$" . number_format($metaTotal, 2, ',', '.') . "\n";
            echo "Quanto está guardado: R$" . number_format($guardado, 2, ',', '.') . "\n";
            echo "Quanto foi gasto até agora: R$" . number_format($gasto, 2, ',', '.') . "\n";
            echo "Quanto falta para atingir a meta: R$" . number_format($atingirmeta, 2, ',', '.') . "\n";
            echo "Seu objetivo está a " . round($porcentagem, 2) . "% concluído.\n";

            readline("Pressione ENTER para voltar ao menu.. \n");
            limparTerminal();
            break;

        case 2:
            $novoGuardado = (float) readline("Digite o valor que deseja guardar: ");
            if ($novoGuardado > 0) {
                $guardado += $novoGuardado;
                $salvarDadosAtuais();
                echo "Valor guardado com sucesso!\n";
            } else {
                echo "Valor inválido. Tente novamente.\n";
            }
            break;

        case 3:
            $novoGasto = (float) readline("Digite o valor do gasto: ");
            if ($novoGasto > 0) {
                $gasto += $novoGasto;
                $salvarDadosAtuais();
                echo "Gasto registrado R$" . number_format($novoGasto, 2, ',', '.') . "\n";
            } else {
                echo "Valor inválido. Tente novamente.\n";
            }
            break;

        case 4:
            echo "Saindo do programa...\n";
            $executando = false;
            break;

        default:
            echo "Opção inválida. Tente novamente.\n";
            break;
    }
}

?>