<?php

require_once '../Services/Autoload.php';
LoginControl::verificar();

include "cabecalho.php";

$atividadeControl = new AtividadeControl();

if(isset($_GET['idTarefa'])):
    $atividadeControl->verificaPermissao();
    $atividades = $atividadeControl->listarPorIdTarefa($_GET['idTarefa']);
?>
    <table class="table table-hover">
        <thead>
            <th>Usuario</th>
            <th>Tipo</th>
            <th>Comentario</th>
            <th>Tempo Gasto</th>
            <th>Total Gasto</th>
            <th>Data de Realizacao</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
        <?php
        foreach ($atividades as $atividade):
        ?>
            <tr>
                <td><?=$atividade->getUsuario()->getNomeCompleto()?></td>
                <td><?=$atividade->getTipo()?></td>
                <td><?=$atividade->getComentario()?></td>
                <td><?=$atividade->getTempoGasto()?></td>
                <td><?=$atividade->getTotalGasto()?></td>
                <td><?=$atividade->getDataRealizacao()?></td>
                <?php if ($atividade->getUsuario()->getId() == $_SESSION['usuario-id']):?>
                <td>
                    <button class='btn' data-toggle='modal' data-target="#modalAlterar" data-id="<?=$atividade->getId()?>" data-tempogasto="<?=$atividade->getTempoGasto()?>"
                    data-tipo="<?=$atividade->getTipo()?>" data-comentario="<?=$atividade->getComentario()?>" data-datarealizacao="<?=$atividade->getDataRealizacao()?>">
                        <img width='16' src='../img/edit-regular.svg' alt=''>
                    </button>
                </td>
                <td>
                    <form action="../Control/AtividadeControl.php" method="post">
                        <input type="hidden" name="acao" value="excluiAtividade">
                        <input type="hidden" name="id" value="<?=$atividade->getId()?>">
                        <button class="btn"><img width='16' src='../img/Icons/lixeiraicone.png' alt=''></button>
                    </form>
                </td>
                <?php endif;?>
            </tr>
        <?php
        endforeach;
        ?>
        </tbody>
    </table>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">
        Cadastrar Nova Atividade
    </button>

    <div class="modal fade" id="modalCadastro" tabindex="-1" >
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cadastro de Atividade</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../Control/AtividadeControl.php" method="post">
                        <div class="form-group">
                            <label for="tipo">Tipo de Atividade</label>
                            <select class="custom-select" name="tipo" id="tipo">
                                <option value="Desenvolvimento">Desenvolvimento</option>
                                <option value="Palestra">Palestra</option>
                                <option value="Manutencao">Manutenção</option>
                                <option value="Aprimoramento">Aprimoramento</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="comentario" class="col-form-label">Comentario</label>
                            <input class="form-control" id="comentario" name="comentario">
                        </div>
                        <div class="form-group">
                            <label for="tempoGasto" class="col-form-label">Tempo Gasto</label>
                            <input class="form-control" id="tempoGasto" name="tempoGasto">
                        </div>
                        <div class="form-group">
                            <label for="dataRealizacao" class="col-form-label">Data de Realizacao</label>
                            <input class="form-control" id="dataRealizacao" name="dataRealizacao">
                        </div>

                        <input type="hidden" name="idTarefa" value="<?=$_GET['idTarefa'];?>">
                        <input type="hidden" name="acao" value="cadastraAtividade">
                        <button type="submit" class="btn btn-primary align-self-center">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAlterar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Alteração de Atividade</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../Control/AtividadeControl.php" method="post">
                        <div class="form-group">
                            <label for="tipo">Tipo de Atividade</label>
                            <select class="custom-select" name="tipo" id="tipo">
                                <option value="Desenvolvimento">Desenvolvimento</option>
                                <option value="Palestra">Palestra</option>
                                <option value="Manutencao">Manutenção</option>
                                <option value="Aprimoramento">Aprimoramento</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="comentario" class="col-form-label">Comentario</label>
                            <input class="form-control" id="comentario" name="comentario">
                        </div>
                        <div class="form-group">
                            <label for="tempoGasto" class="col-form-label">Tempo Gasto</label>
                            <input class="form-control" id="tempoGasto" name="tempoGasto">
                        </div>
                        <div class="form-group">
                            <label for="dataRealizacao" class="col-form-label">Data de Realizacao</label>
                            <input class="form-control" id="dataRealizacao" name="dataRealizacao">
                        </div>

                        <input type="hidden" name="idTarefa" value="<?=$_GET['idTarefa'];?>">
                        <input type="hidden" name="acao" value="alteraAtividade">
                        <input type="hidden" name="id" id="id">
                        <button type="submit" class="btn btn-primary align-self-center">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
    endif;
?>

<script src="../js/jquery.js"></script>
<script src="../js/funcoesAtividade.js"></script>
<script src="../js/bootstrap.js"></script>
</body>
</html>