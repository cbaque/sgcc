<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Gesti&oacute;n Pago</h3>
                <div class="card-header-right">
                    <button type="button" onclick="location.href='<?php echo base_url();?>/PagosController/indexPagoPendiente'" class="btn btn-light">Regresar</button>
                </div>
            </div>
            <div class="card-body">

            <div class="table-responsive">
                  <table class="table">
                      <thead>
                          <tr>
                            <th>Estudiante</th>
                            <th>Curso</th>
                            <th>Cuota</th>
                            <th>No. Cuota</th>
                            <th>Fecha de Pago</th>
                            <th>Forma Pago</th>
                            <th>Número Documento</th>
                            <th>Estado</th>
                            <th>Accion</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php
                        foreach ($pagosPendientes as $pago) {
                        ?>
                        <tr>
                            <td><?=$pago['ESTNOMBRE']?></td>
                            <td><?=$pago['CURNOMBRE']?></td>
                            <td><?=$pago['PAGCUOTA']?></td>
                            <td><?=$pago['PAGNUMCUOTA']?></td>
                            <td><?=$pago['PAGFECREGPAGO']?></td>
                            <td><?=$pago['FORMAPAGO']?></td>
                            <td><?=$pago['NUMDOCPAGO']?></td>
                            <td><?=$pago['PAGESTADO']?></td>
                            <td>
                                <button type="button" 
                                    onclick="registrarPago(<?=$pago['PAGCUOTA']?>, <?=$pago['PAGID']?>, <?=$pago['PAGNUMCUOTA']?>,<?=$pago['MATID']?>)"
                                    class="btn btn-primary"
                                    data-toggle="modal"
                                    data-target="#modal-default">Pagar</button>

                            </td>
                        </tr>
                        <?php
                        }
                    ?>
                      </tbody>
                  </table>
              </div>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">
    <form action="<?php echo base_url();?>/PagosController/registrarPago" method="POST" autocomplete="off">
        <input type="hidden" id="pagoId" name="pagoId" value="">
        <input type="hidden" id="MATID" name="MATID">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="demoModalLabel">Registrar Pago</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                              <div class="form-group">
                                  <label for="numeroCuota">No. Cuota</label>
                                  <input type="text" class="form-control" readonly="true" id="numeroCuota" name="numeroCuota" value="" placeholder="no. cuota...">
                              </div>
                        </div>                                                
                        <div class="col-md-6">
                              <div class="form-group">
                                  <label for="valorPago">Valor</label>
                                  <input type="text" class="form-control" readonly="true" id="valorPago" name="valorPago" value="" placeholder="valor pago...">
                              </div>
                        </div>                        
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                              <div class="form-group">
                                    <label for="formaPago">Forma de Pago</label>
                                    <select name="formaPago" id="formaPgo" class="form-control">
                                        <option value="EFECTIVO">EFECTIVO</option>
                                        <option value="CHEQUE">CHEQUE</option>
                                        <option value="DEBITO">DEBITO</option>
                                    </select>
                              </div>
                        </div> 
                        
                    
                        <div class="col-md-6">
                              <div class="form-group">
                                  <label for="numeroDocumento">No. Documento de Pago</label>
                                  <input type="text" class="form-control" id="numeroDocumento" name="numeroDocumento" value="" placeholder="digite...">
                              </div>
                        </div>       
                        
                      
                    </div>                    
    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function registrarPago(valorPago, pagoId, numeroCuotas,matid){
        $("#modal-default #numeroCuota").find("option").remove().end().append();
        // console.log('valor: ', valorPago);
        // console.log('pagoId: ', pagoId);
      
        // console.log('numeroCuotas: ', numeroCuotas);
        
        // for (i=1; i<= numeroCuotas; i++){
        //     var o = new Option("option text", "value");
        //     $(o).html(i, i);
        //     $("#modal-default #numeroCuota").append(o);
        // }
        $("#modal-default #numeroCuota").val(numeroCuotas);
        $("#modal-default #valorPago").val(valorPago);
        $("#modal-default #numeroDocumento").val('');
        $("#modal-default #pagoId").val(pagoId);
        $("#modal-default #MATID").val(matid);
    }
</script>

