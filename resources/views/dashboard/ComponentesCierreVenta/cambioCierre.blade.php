<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4">
            <br>

            <table class="table table-bordered caption-top ">
                <h3>Cambio recibido</h3>
                <caption>
                    <h5>Denominacion</h5>
                </caption>
                <tbody>
                    <tr>
                        <th scope="row" class="col-4">$0.01</th>
                        <td class="col-8">
                            <span>{{$cambio->centavo_uno}} </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$0.05</th>
                        <td class="col-8">
                            <span>{{$cambio->centavo_cinco}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$0.10</th>
                        <td class="col-8">
                            <span> {{$cambio->centavo_diez}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$0.25</th>
                        <td class="col-8">
                            <span> {{$cambio->centavo_veinticinco}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$1.00</th>
                        <td class="col-8">
                            <span>{{$cambio->dolar_uno}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$5.00</th>
                        <td class="col-8">
                            <span>{{$cambio->dolar_cinco}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$10.00</th>
                        <td class="col-8">
                            <span>{{$cambio->dolar_diez}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$20.00</th>
                        <td class="col-2">
                            <span>{{$cambio->dolar_veinte}}</span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">Total</th>
                        <td class="col-2">
                            $<span>{{$cambio->total}}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <br>
            <form action="{{ url('factura/crearEfectivo') }}" method="post">
                @csrf
                <input name="tipo" hidden value="r">
                <table class="table table-bordered caption-top ">
                    <h3>Cambio Entregado</h3>
                    <caption>
                        <h5>Denominacion</h5>
                    </caption>
                    <tbody>
                        <tr>
                            <th scope="row" class="col-4">$0.01</th>
                            <td class="col-8">
                                <input type="number" value="0" Cambio-data="0.01" step="1" oninput="calcularCambio()" name="v-centavo_uno" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-4">$0.05</th>
                            <td class="col-8">
                                <input type="number" value="0" Cambio-data="0.05" step="1" oninput="calcularCambio()" name="v-centavo_cinco" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-4">$0.10</th>
                            <td class="col-8">
                                <input type="number" value="0" Cambio-data="0.1" step="1" oninput="calcularCambio()" name="v-centavo_diez" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-4">$0.25</th>
                            <td class="col-8">
                                <input type="number" value="0" Cambio-data="0.25" step="1" oninput="calcularCambio()" name="v-centavo_veinticinco" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-4">$1.00</th>
                            <td class="col-8">
                                <input type="number" value="0" Cambio-data="1.0" step="1" oninput="calcularCambio()" name="v-dolar_uno" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-4">$5.00</th>
                            <td class="col-8">
                                <input type="number" value="0" Cambio-data="5.0" step="1" oninput="calcularCambio()" name="v-dolar_cinco" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-4">$10.00</th>
                            <td class="col-8">
                                <input type="number" value="0" Cambio-data="10.0" step="1" oninput="calcularCambio()" name="v-dolar_diez" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-4">$20.00</th>
                            <td class="col-8">
                                <input type="number" value="0" Cambio-data="20.0" step="1" oninput="calcularCambio()" name="v-dolar_veinte" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" class="col-4">Total</th>
                            <td class="col-8">
                                $<span id="totalCambioV">0.0</span>
                                <input id="totalInCambio" name="totalRetorno" value="0" hidden>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>

<script>

</script>