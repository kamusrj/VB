<div class="container">
    <div class="row">
        <div class="col-md-5">
            <br>
            <h3><i class="fa-solid fa-file-invoice-dollar"> Detalle de facturas</i> </h3>

            <br>
            <table class="table table-bordered caption-top ">

                <tbody>
                    <tr>
                        <th scope="row" class="col-4">Facturas Entregada</th>
                        <td class="col-8">
                            {{$factura->total_facturas}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">Llenada</th>
                        <td class="col-8">
                            {{$factura->total_no_anuladas}}
                        </td>
                    </tr>


                    <tr>
                        <th scope="row" class="col-4">Anuladas</th>
                        <td class="col-8">
                            {{$factura->total_anuladas}}
                        </td>
                    </tr>

                    <tr>
                        <th scope="row" class="col-4">Utilizadas</th>
                        <td class="col-8">
                            {{$factura->total_utilizadas}}
                        </td>
                    </tr>

                    <tr>
                        <th scope="row" class="col-4">Sin utilizar</th>
                        <td class="col-8">
                            {{$factura->total_sin_utilizar}}
                        </td>
                    </tr>

                </tbody>
            </table>



        </div>
    </div>
</div>