<?php

// Preenche o select com as categorias
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
                if (count($dados) == 1) {
                    $html .= '<option value="' . $dados[0]->categoriaid . '" selected="selected">' . $dados[0]->namecategoria . '</option>';
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
        }
        return $html;
    }
}

// Preenche o select com as subcategorias
if (!function_exists('selectsubcategorias')) {
    function selectsubcategorias($where = null, $selecionado = null, $defalt = null)
    {
        $html = '';
        if ($defalt !== null) {
            $html .= '<option value="' . $defalt[0] . '">' . $defalt[1] . '</option>';
        }
        require_once MODELS . 'msubcategorias.php';
        $mca = new Msubcategorias();
        $dados = $mca->getAllSubCategories($where);
        if (count($dados) <= 0) {
            $html .= '<option value="0">Sem resultado...</option>';
        } else {
            if ($selecionado === null) {
                foreach ($dados as $key => $valor) {
                    $html .= '<option value="' . $valor->subcategoriaid . '">' . $valor->namesubcategoria . '</option>';
                }
            } else {
                if (count($dados) == 1) {
                    $html .= '<option value="' . $dados[0]->subcategoriaid . '" selected="selected">' . $dados[0]->namesubcategoria . '</option>';
                } else {
                    foreach ($dados as $key => $valor) {
                        if (intval($selecionado) === intval($valor->subcategoriaid)) {
                            $html .= '<option value="' . $valor->subcategoriaid . '" selected="selected">' . $valor->namesubcategoria . '</option>';
                        } else {
                            $html .= '<option value="' . $valor->subcategoriaid . '">' . $valor->namesubcategoria . '</option>';
                        }
                    }
                }
            }
        }
        return $html;
    }
}