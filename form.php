<section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Serviço Cliente</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="../../model/dao/servicocliente/update.php" method="POST">
                            <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
                            <input type="hidden" name="idcliente" value="<?php echo $dados['IDCLIENTE']; ?>">
                            <input type="hidden" name="id" value="<?php echo $dados['IDSERVICOCLIENTE']; ?>">

                            <div class="input-field col s12">
                                <label for="nome">Cliente</label>
                                <div class="labelresp border border-dark">
                                    <?php echo $dados['CLIENTENOME'];?>
                                </div>
                            </div>

                            <div class="atributos">
                                <div class="input-field col s12">
                                    <label for="nome">Sistema</label>
                                    <div class="labelresp border border-dark">
                                        <?php echo $dados['SERVICONOME'];?>
                                    </div>
                                </div>

                                <div class="input-field col s12">
                                    <label for="nome">Estado</label>
                                    <div class="labelresp border border-dark">
                                        <?php echo $dados['ESTADO'];?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a href="../clienteview/clienteview.php?user=<?php echo $idusuario; ?>&id=<?php echo $dados['IDCLIENTE']; ?>"
                                            style="margin-top: 20px" class="btn btn-secondary">Voltar</a>
                                        
                                        <a href="../servicocliente/edit.php?user=<?php echo $idusuario?>&id=<?php echo $dados['IDSERVICOCLIENTE']; ?>"
                                            style="margin-top: 20px" class="btn btn-warning float-right">Editar</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>