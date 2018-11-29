	<head>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">		
		
		<style type="text/css">
			div.border{
		    border: 1px solid black;
			}
  	</style>
    
    <meta charset="utf-8"> 

	</head>

    <table style="width: 100%">
      <tr>
        <td style="width: 47%;">
          <table>
            <tbody>        
              
              <tr>        
                <td>
                    <div name="logo" style="width: 300px; height: 100px">
                      <?php if($invoiceObject->company->logo): ?>                        
                        <img src="data:image/png;base64,<?php echo e($invoiceObject->company->logo); ?>" style="margin-top: -15px">  
                      <?php endif; ?>
                    </div>
                </td>
              </tr>

              <tr>
                <td height="20px"></td>
              </tr>

              <tr>        
                <td style="border:0px solid black">
                  <table>
                    <tr>
                      <td style="font-size: 11px"><?php echo e($invoiceObject->company->social_reason); ?></td>                      
                    </tr>

                    <tr>
                      <td style="font-size: 11px"><?php echo e($invoiceObject->company->comercial_name); ?></td>
                    </tr>

                    <tr>
                      <td height="5px"></td>
                    </tr>

                    <tr>
                      <td style="font-size: 11px"><div style="font-weight: bold; font-size: 11px">Dir. Matriz: </div><?php echo e($invoiceObject->company->address); ?></td>
                    </tr>

                    <tr>
                      <td height="5px"></td>
                    </tr>

                    <tr>
                      <td style="font-size: 11px"><div style="font-weight: bold; font-size: 11px">Dir. Sucursal: </div><?php echo e($invoiceObject->branch->address); ?></td>
                    </tr>
                    
                    <tr>
                      <td height="5px"></td>
                    </tr>

                    <?php if($invoiceObject->company->special_code != NULL): ?>
                      <tr>
                        <td style="font-size: 11px"><div style="font-weight: bold; font-size: 11px">Contribuyente Especial Nro.:</div> <?php echo e($invoiceObject->company->special_code); ?></td>
                      </tr>

                      <tr>
                        <td height="5px"></td>
                      </tr>                      
                    <?php endif; ?>

                    <?php if($invoiceObject->company->is_artisan == 1): ?>
                      <tr>
                        <td style="font-size: 11px"><div style="font-weight: bold; font-size: 11px">Calificación Artesanal: </div><?php echo e($invoiceObject->company->register_number); ?></td>
                      </tr>

                      <tr>
                        <td height="5px"></td>
                      </tr>
                    <?php endif; ?>

                    <?php if($invoiceObject->company->is_accounting == 1): ?>
                      <tr>
                        <td><div style="font-weight: bold; font-size: 11px">OBLIGADO A LLEVAR CONTABILIDAD: SI</div></td>
                      </tr>                    
                    <?php else: ?>
                      <tr>
                        <td><div style="font-weight: bold; font-size: 11px">OBLIGADO A LLEVAR CONTABILIDAD: NO</div></td>
                      </tr>
                    <?php endif; ?>

                  </table>
                  
                </td>
              </tr>
            
            </tbody>  
          </table>
        </td>

        <td style="width: 6%">          
        </td>
        
        <td style="width: 47%; vertical-align:top;">
          <table border="1">
            <tbody>        
              
              <tr>        
                <td>
                  
                  <table border="0">
                    <tr>
                      <td style="font-size: 11px"><div style="font-weight: bold; font-size: 11px">R.U.C.:</div> <?php echo e($invoiceObject->company->ruc); ?></td>
                    </tr>

                    <tr>
                      <td height="5px"></td>
                    </tr>

                    <tr>
                      <td><div style="font-weight: bold; font-size: 11px">F A C T U R A</div></td>
                    </tr>
                    <tr>
                      <td style="font-size: 11px">No. <?php echo e($invoiceObject->company->emission_code . "-" . $invoiceObject->branch->emission_point . "-" . $invoiceObject->invoice->principal_code); ?></td>
                    </tr>

                    <tr>
                      <td height="5px"></td>
                    </tr>

                    <tr>
                      <td><div style="font-weight: bold; font-size: 11px">Número de Autorización</div></td>
                    </tr>
                    <tr>
                      <td style="font-size: 11px"><?php echo e($invoiceObject->invoice->auth_code); ?></td>
                    </tr>

                    <tr>
                      <td height="5px"></td>
                    </tr>

                    <tr>
                      <td><div style="font-weight: bold; font-size: 11px">Fecha y hora de autorización</div></td>
                    </tr>

                    <tr>
                      <td style="font-size: 11px"><?php echo e($invoiceObject->invoice->auth_date ? $invoiceObject->invoice->auth_date : ''); ?></td>
                    </tr>

                    <tr>
                      <td height="5px"></td>
                    </tr>

                    <?php if($invoiceObject->invoice->environment_type == 1): ?>                       
                       <tr>
                         <td style="font-size: 11px"><div style="font-weight: bold">Ambiente:</div> PRUEBAS</td>
                       </tr>
                    <?php else: ?>
                       <tr>
                         <td style="font-size: 11px"><div style="font-weight: bold">Ambiente:</div> PRODUCCIÓN</td>
                       </tr>
                    <?php endif; ?>

                    <tr>
                      <td height="5px"></td>
                    </tr>

                    <?php if($invoiceObject->invoice->emission_type == 1): ?>
                      <tr>
                        <td style="font-size: 11px"><div style="font-weight: bold">Emisión: </div> NORMAL</td>
                      </tr>                      
                    <?php endif; ?>

                    <tr>
                      <td height="5px"></td>
                    </tr>

                    <tr>
                      <td style="font-size: 11px"><div style="font-weight: bold">Clave de acceso</div></td>
                      <img style="width: 50%; margin-left: 5px; margin-right: 5px" src="https://barcode.tec-it.com/barcode.ashx?data=<?php echo e($invoiceObject->invoice->auth_code); ?>&code=EANUCC128&multiplebarcodes=false&translate-esc=true&unit=Fit&dpi=96&imagetype=Gif&rotation=0&color=%23000000&bgcolor=%23ffffff&qunit=Mm&quiet=0"/> 
                    </tr>
                  </table>
                  
                </td>
              </tr>                          
            </tbody>  
          </table>          
        </td>
      </tr>
    </table>

    <br>                 

    <table width="100%" style="border:1px solid black">
      <tbody>
        <tr>
          <td style="width: 1%"></td>
          <?php if($invoiceObject->client->social_reason != NULL): ?>
            <td style="width: 70%; font-size: 11px">Razón social / Nombres y Apellidos: <br><?php echo e($invoiceObject->client->social_reason); ?></td>
          <?php else: ?>
            <td style="width: 70%; font-size: 11px">Razón social / Nombres y Apellidos: <br><?php echo e($invoiceObject->client->comercial_name); ?></td>
          <?php endif; ?>
          <td style="width: 1%"></td>
          <td style="width: 25%; font-size: 11px">            
              <?php echo e($invoiceObject->client->idClass); ?>:
              <?php echo e($invoiceObject->client->identification); ?>                          
          </td>          
        </tr>
        <tr>
          <td style="width: 1%"></td>
          <td style="font-size: 11px">Dirección: <?php echo e($invoiceObject->client->address); ?></td>
          <td></td>
          <td style="font-size: 11px">Teléfono: <?php echo e($invoiceObject->client->phone); ?></td>
        </tr>
        <tr>
          <td style="width: 1%"></td>
          <td style="font-size: 11px">Fecha de Emisión: <?php echo e($invoiceObject->invoice->invoice_date); ?></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>      
    
    <br><br>

    <table width="100%">
      <thead>
        <tr>
          <th style="width: 10%; font-size: 11px"><center>Cód. Principal</center></th>
          <th style="width: 13%; font-size: 11px"><center>Cód. Auxiliar</center></th>
          <th style="width: 5%; font-size: 11px"><center>Cant.</center></th>
          <th style="width: 36%; font-size: 11px"><center>Descripción</center></th>            
          <th style="width: 12%; font-size: 11px"><center>Precio Unitario</center></th>            
          <th style="width: 12%; font-size: 11px"><center>Descuento</center></th>
          <th style="width: 12%; font-size: 11px"><center>Precio Total</center></th>
        </tr>
      </thead>  
      <tbody>
        <?php $__currentLoopData = $invoiceObject->invoice_line; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td style="font-size: 11px"><?php echo e($line->principal_code); ?></td>
            <td style="font-size: 11px"><?php echo e($line->auxiliary_code); ?></td>            
            <td style="font-size: 11px" align="center"><?php echo e((int)$line->quantity); ?></td>
            <td style="font-size: 9px"><?php echo e($line->description); ?></td>
            <td style="font-size: 11px" align="right"><?php echo e(number_format($line->unit_price, 2, ',', '.')); ?></td>
            <td style="font-size: 11px" align="right"><?php echo e($line->discount > 0 ? $line->discount."%" : ''); ?></td>            
            <td style="font-size: 11px" align="right"><?php echo e(number_format($line->totalCostNoTax, 2, ',', '.')); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table> 

    <br><br>  

    <table width="100%">
      <tbody>
        <tr>
          <td style="width: 58%; vertical-align:top">
            <table style="border:1px solid black" width="100%">      
              <tbody>                
                <tr>
                  <td style="font-weight: bold; font-size: 11px" align="center">Información Adicional</td>
                  <td>
                    <tr> 
                      <td style="font-weight: bold; font-size: 11px" align="center">Dirección</td> 
                      <td style="font-size: 11px"><?php echo e($invoiceObject->client->address); ?></td>
                    </tr> 
                  </td>                              
                  
                  <td>
                    <tr> 
                      <td style="font-weight: bold; font-size: 11px" align="center">Email</td> 
                      <td style="font-size: 11px"><?php echo e($invoiceObject->client->email); ?></td>
                    </tr>
                  </td>

                  <?php if(isset($invoiceObject->invoice->source_country_name) && $invoiceObject->invoice->source_country_name != null): ?>
                  <td>
                    <tr> 
                      <td style="font-weight: bold; font-size: 11px" align="center">País de Origen</td> 
                      <td style="font-size: 11px"><?php echo e($invoiceObject->invoice->source_country_name); ?></td>
                    </tr>
                  </td>
                  <?php endif; ?>

                  <?php if(isset($invoiceObject->invoice->destination_country_name) && $invoiceObject->invoice->destination_country_name != null): ?>
                  <td>
                    <tr> 
                      <td style="font-weight: bold; font-size: 11px" align="center">País de Destino</td> 
                      <td style="font-size: 11px"><?php echo e($invoiceObject->invoice->destination_country_name); ?></td>
                    </tr>
                  </td>
                  <?php endif; ?>

                  <?php if(isset($invoiceObject->invoice->source_harvour) && $invoiceObject->invoice->source_harvour != null): ?>
                  <td>
                    <tr> 
                      <td style="font-weight: bold; font-size: 11px" align="center">Puerto de Origen</td> 
                      <td style="font-size: 11px"><?php echo e($invoiceObject->invoice->source_harvour); ?></td>
                    </tr>
                  </td>
                  <?php endif; ?>

                  <?php if(isset($invoiceObject->invoice->destination_harvour) && $invoiceObject->invoice->destination_harvour != null): ?>
                  <td>
                    <tr> 
                      <td style="font-weight: bold; font-size: 11px" align="center">Puerto de Destino</td> 
                      <td style="font-size: 11px"><?php echo e($invoiceObject->invoice->destination_harvour); ?></td>
                    </tr>
                  </td>
                  <?php endif; ?>

                </tr>                
              </tbody>
            </table> 
          </td>

          <td style="width: 4%"></td>
          
          <td style="width: 38%">
            <table width="100%">      
              <tbody>                
                <tr>                  
                  
                  <td>
                    <tr> 
                      <td style="font-weight: bold; width: 50%; font-size: 10px" align="right">SUBTOTAL 12%</td> 
                      <td align="right" style="font-size: 11px">$<?php echo e($invoiceObject->invoice->subtotal_12); ?></td>
                    </tr> 
                  </td>

                  <td>
                    <tr> 
                      <td style="font-weight: bold; width: 50%; font-size: 10px" align="right">SUBTOTAL 0%</td> 
                      <td align="right" style="font-size: 11px">$<?php echo e($invoiceObject->invoice->subtotal_0); ?></td>
                    </tr> 
                  </td>

                  <td>
                    <tr> 
                      <td style="font-weight: bold; width: 50%; font-size: 10px" align="right">SUBTOTAL NO SUJETO DE IVA</td> 
                      <td align="right" style="font-size: 11px">$<?php echo e($invoiceObject->invoice->subtotal_no_objeto); ?></td>
                    </tr> 
                  </td>
                  
                  <td>
                    <tr> 
                      <td style="font-weight: bold; width: 50%; font-size: 10px" align="right">SUBTOTAL SIN IMPUESTOS</td> 
                      <td align="right" style="font-size: 11px">$<?php echo e($invoiceObject->invoice->subtotal_exento); ?></td>
                    </tr> 
                  </td>
                  
                  <td>
                    <tr> 
                      <td style="font-weight: bold; width: 50%; font-size: 10px" align="right">DESCUENTO</td> 
                      <td align="right" style="font-size: 11px">$<?php echo e($invoiceObject->invoice->total_discount); ?></td>
                    </tr> 
                  </td>                  

                  <td>
                    <tr> 
                      <td style="font-weight: bold; width: 50%; font-size: 10px" align="right">IVA 12%</td> 
                      <td align="right" style="font-size: 11px">$<?php echo e($invoiceObject->invoice->total_12); ?></td>
                    </tr> 
                  </td>

                  <td>
                    <tr> 
                      <td style="font-weight: bold; width: 50%; font-size: 10px" align="right">PROPINA</td> 
                      <td align="right" style="font-size: 11px">$<?php echo e($invoiceObject->invoice->tip); ?></td>
                    </tr> 
                  </td>

                  <td>
                    <tr> 
                      <td style="font-weight: bold; width: 50%; font-size: 10px" align="right">VALOR TOTAL</td> 
                      <td align="right" style="font-size: 11px">$<?php echo e($invoiceObject->invoice->total_invoice); ?></td>
                    </tr> 
                  </td>
                </tr>

              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>

    <br><br> 

    <?php if(count($invoiceObject->invoice_payment) > 0): ?>
    <table width="65%" border="1">
      <thead>
        <tr>
          <th style="width: 70%; font-size: 11px" align="center">Forma de Pago</th>
          <th style="width: 30%; font-size: 11px" align="center">Valor</th>
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $invoiceObject->invoice_payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td style="font-size: 11px"><?php echo e($payment->paymentName); ?></td>
            <td style="font-size: 11px" align="center"><?php echo e($payment->paymentMount); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
    <?php endif; ?>