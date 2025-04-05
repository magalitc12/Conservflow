<table>
    <tr>
        <td colspan="16" style="color: #0070c0;">CONSERFLOW S.A. DE C.V.</td>
    </tr>

    <tr>
        <td rowspan="3"></td> <!-- imagen -->
        <td rowspan="3" colspan="14">HISTÓRICO DE COMPRAS</td>
        <td colspan="1" style="text-align : center;">
            CÓDIGO
        </td>
        <td colspan="1" style="text-align : center;">PCO-01/F-03</td>
    </tr>
    <tr>
        <td colspan="1" style="text-align : center;">REVISIÓN</td>
        <td colspan="1" style="text-align : center;">00</td>
    </tr>
    <tr>
        <td colspan="1" style="text-align : center;">EMISIÓN</td>
        <td colspan="1" style="text-align : center;">29.JUN.20</td>
    </tr>

    <tr>
        <td colspan="17"></td>
    </tr>
    <tr>
        <td style="background-color: #0070c0; color: white;">Fecha de requisición</td>
        <td style="background-color: #0070c0; color: white;">Requisición</td>
        <td style="background-color: #0070c0; color: white;">Fecha de Orden</td>
        <td style="background-color: #0070c0; color: white;">Orden de Compra</td>
        <td style="background-color: #0070c0; color: white;">Proyecto</td>
        <td style="background-color: #0070c0; color: white;">Clasificación del producto</td>
        <td style="background-color: #0070c0; color: white;">Proveedor</td>
        <td style="background-color: #0070c0; color: white;">Credito</td>
        <td style="background-color: #0070c0; color: white;">Periódo de entrega</td>
        <td style="background-color: #0070c0; color: white;">Cant.</td>
        <td style="background-color: #0070c0; color: white;">UM</td>
        <td style="background-color: #0070c0; color: white;">Descripción</td>
        <td style="background-color: #0070c0; color: white;">Precio Unitario</td>
        <td style="background-color: #0070c0; color: white;">Total</td>
        <td style="background-color: #0070c0; color: white;">Total IVA</td>
        <td style="background-color: #0070c0; color: white;">Moneda</td>
        <td style="background-color: #0070c0; color: white;">Estatus de Orden</td>
    </tr>
    <?php $__currentLoopData = $ocs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($oc->fecha_requi); ?></td>
        <?php if($oc->conrequisicion==0): ?>
        <td>REQ-<?php echo e($oc->nombre_corto); ?>-000-SR</td>
        <?php elseif(str_ends_with($oc->req_folio,"-SR")): ?>
        <td>REQ-<?php echo e($oc->nombre_corto); ?>-000-SR</td>
        <?php else: ?>
        <td><?php echo e($oc->req_folio); ?></td>
        <?php endif; ?>
        <td><?php echo e($oc->fecha_orden); ?></td>
        <td><?php echo e($oc->oc_folio); ?></td>
        <td><?php echo e($oc->nombre_corto); ?></td>
        <td><?php echo e($oc->grupo); ?></td>
        <td><?php echo e($oc->razon_social); ?></td>
        <td><?php echo e($oc->metodo); ?></td>
        <td><?php echo e($oc->periodo_entrega); ?></td>
        <td><?php echo e($oc->cantidad); ?></td>
        <td><?php echo e($oc->um==null?'N/D':$oc->um); ?></td>
        <td><?php echo e($oc->descripcion); ?></td>
        <td>$<?php echo e(number_format($oc->precio_unitario,2)); ?></td>
        <td>$<?php echo e(number_format($oc->total,2)); ?></td>
        <td>$<?php echo e(number_format(round($oc->total*1.16,2),2)); ?></td>
        <?php if($oc->moneda==1): ?>
        <td>Dolar (USD)</td>
        <?php elseif($oc->moneda==2): ?>
        <td>Moneda Nacional (MXN)</td>
        <?php else: ?>
        <td>Euros (EUR)</td>
        <?php endif; ?>
        <td><?php echo e($oc->condicion==1?'ACTIVA':'CERRADA'); ?></td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</table>