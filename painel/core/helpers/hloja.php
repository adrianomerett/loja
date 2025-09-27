<?php
if (!function_exists('selectcategorias')) {
    function selectcategorias($where = null, $selecionado = null, $defalt = null)
    {
        $html = '';
        if ($defalt !== null) {
            $html .= '<option value="' . $defalt[0] . '">' . $defalt[1] . '</option>';
        }
        require_once MODELS . 'mcategorias.php';
        $mca = new Mcategorias();
        $dados = $mca->getAllCategories($where);
        if (count($dados) <= 0) {
            $html .= '<option value="0">Sem resultado...</option>';
        } else {
            if ($selecionado === null) {
                foreach ($dados as $key => $valor) {
                    $html .= '<option value="' . $valor->categoriaid . '">' . $valor->namecategoria . '</option>';
                }
            } else {
                foreach ($dados as $key => $valor) {
                    if (intval($selecionado) === intval($valor->categoriaid)) {
                        $html .= '<option value="' . $valor->categoriaid . '" selected="selected">' . $valor->namecategoria . '</option>';
                    } else {
                        $html .= '<option value="' . $valor->categoriaid . '">' . $valor->namecategoria . '</option>';
                    }
                }
            }
        }
        return $html;
    }
}
