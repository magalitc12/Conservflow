<table>
  <tr>
    <td colspan="9" style="text-align : center;">CONSERFLOW S.A. DE C.V.</td>
  </tr>
  <tr>
  			<td rowspan="3"></td>
  			<td rowspan="3" colspan="6" style="text-align : center;">
          <b>REPORTE DE EXISTENCIAS</b>
        </td>
  			<td style="text-align : center;">CÓDIGO</td>
  			<td style="text-align : center;">PAL-01/F-04</td>
  		</tr>
  		<tr>
  			<td style="text-align : center;">REVISIÓN</td>
  			<td style="text-align : center;">00</td>
  		</tr>
  		<tr>
  			<td style="text-align : center;">EMISIÓN</td>
  			<td style="text-align : center;">01.ABR.20</td>
  		</tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td colspan="5"></td>
    <td colspan="2" style="background-color : #8E8F93; text-align : center;">Fecha del Reporte</td>
    <td colspan="2" style="text-align : center;"> <b><?php echo e($mes); ?> <?php echo e($anio); ?></b>
    </td>
  </tr>
  <thead>
    <tr>
      <th style="background-color : #5E7EFF; text-align : center;"><b>Categoria</b></th>
      <th  width="80" style="background-color : #5E7EFF; text-align : justify;"><b>Artículo</b></th>
      <th style="background-color : #5E7EFF; text-align : center;"><b>Unidad</b></th>
      <th style="background-color : #5E7EFF; text-align : center;"><b>Precio Unitario</b></th>
      <th style="background-color : #5E7EFF; text-align : center;"><b>Total</b></th>
      <th style="background-color : #5E7EFF; text-align : center;" width="30"><b>Proyecto</b></th>
      <th style="background-color : #5E7EFF; text-align : center;"><b>Entradas</b></th>
      <th style="background-color : #5E7EFF; text-align : center;"><b>Salidas</b></th>
      <th style="background-color : #5E7EFF; text-align : center;"><b>Existencia</b></th>
    </tr>
  </thead>
</table>

<tbody>
  <?php $__currentLoopData = $array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $articulo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <td><?php echo e($articulo['a']->nombre_grupo); ?></td>
    <td><?php echo e($articulo['a']->descripcion); ?></td>
    <td><?php echo e($articulo['a']->unidad); ?></td>
    <td><?php echo e($articulo['a']->precio_unitario); ?></td>
    <td></td>
    <td><?php echo e($articulo['a']->nombre_corto); ?></td>
    <td><?php echo e($articulo['a']->cantidad); ?></td>
    <td><?php echo e($articulo['b']); ?></td>
    <td><?php echo e($articulo['a']->cantidad - $articulo['b']); ?></td>
  </tr>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
