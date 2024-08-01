<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RomanNumeralController extends Controller
{
    // Método para exibir a página inicial
    public function index()
    {
        // Retorna a view 'convert'
        return view('convert');
    }

    // Método para lidar com a conversão dos números
    public function convert(Request $request)
    {
        // Obtém o valor de entrada do formulário
        $input = $request->input('input');

        // Obtém o tipo de conversão selecionado (romano para arábico ou arábico para romano)
        $type = $request->input('type');

        // Se o tipo for 'to_arabic', converte de romano para arábico
        if ($type == 'to_arabic') {
            $result = $this->romanToArabic($input);
        }
        // Se o tipo for 'to_roman', converte de arábico para romano
        else {
            $result = $this->arabicToRoman($input);
        }

        // Retorna a view 'convert' com o resultado da conversão
        return view('convert', ['result' => $result]);
    }

    // Método privado para converter número romano para arábico
    private function romanToArabic($roman)
    {
        // Mapeamento dos valores romanos para arábicos
        $map = ['M' => 1000, 'D' => 500, 'C' => 100, 'L' => 50, 'X' => 10, 'V' => 5, 'I' => 1];

        // Variável para armazenar o resultado da conversão
        $result = 0;

        // Variável para armazenar o valor anterior no loop
        $previousValue = 0;

        // Loop através de cada caractere do número romano
        for ($i = 0; $i < strlen($roman); $i++) {
            // Obtém o valor atual do caractere romano
            $currentValue = $map[$roman[$i]];

            // Se o valor atual é maior que o valor anterior, ajusta o resultado para subtração
            if ($currentValue > $previousValue) {
                $result += $currentValue - 2 * $previousValue;
            }
            // Caso contrário, adiciona o valor atual ao resultado
            else {
                $result += $currentValue;
            }

            // Atualiza o valor anterior para o próximo loop
            $previousValue = $currentValue;
        }

        // Retorna o resultado da conversão
        return $result;
    }

    // Método privado para converter número arábico para romano
    private function arabicToRoman($arabic)
    {
        // Mapeamento dos valores arábicos para romanos
        $map = [
            1000 => 'M', 900 => 'CM', 500 => 'D', 400 => 'CD',
            100 => 'C', 90 => 'XC', 50 => 'L', 40 => 'XL',
            10 => 'X', 9 => 'IX', 5 => 'V', 4 => 'IV', 1 => 'I'
        ];

        // Variável para armazenar o resultado da conversão
        $result = '';

        // Loop através do mapeamento, do maior para o menor valor
        foreach ($map as $value => $roman) {
            // Enquanto o valor arábico for maior ou igual ao valor atual do mapa
            while ($arabic >= $value) {
                // Adiciona o caractere romano correspondente ao resultado
                $result .= $roman;
                // Subtrai o valor do número arábico
                $arabic -= $value;
            }
        }

        // Retorna o resultado da conversão
        return $result;
    }
}
