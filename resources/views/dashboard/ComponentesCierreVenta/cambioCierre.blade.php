<div class="container">
    <div class="row">
        <div class="col-md-5">
            <br>

            <table class="table table-bordered caption-top ">
                <caption>
                    <h5>Denominacion</h5>
                </caption>
                <tbody>
                    <tr>
                        <th scope="row" class="col-4">$0.01</th>
                        <td class="col-8">
                            <input type="number" value="{{$cambio->centavo_uno}}" data-denominacion="0.01" class="form-control" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$0.05</th>
                        <td class="col-8">
                            <input type="number" value="{{$cambio->centavo_cinco}}" data-denominacion="0.05" class="form-control" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$0.10</th>
                        <td class="col-8">
                            {{$cambio->centavo_diez}}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$0.25</th>
                        <td class="col-8">
                            <input type="number" value="{{$cambio->centavo_veinticinco}}" data-denominacion="0.25" class="form-control" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$1.00</th>
                        <td class="col-8">
                            <input type="number" value="{{$cambio->dolar_uno}}" data-denominacion="1.0" class="form-control" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$5.00</th>
                        <td class="col-8">
                            <input type="number" value="{{$cambio->dolar_cinco}}" data-denominacion="5.0" class="form-control" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$10.00</th>
                        <td class="col-8">
                            <input type="number" value="{{$cambio->dolar_diez}}" data-denominacion="10.0" class="form-control" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">$20.00</th>
                        <td class="col-8">
                            <input type="number" value="{{$cambio->dolar_veinte}}" data-denominacion="20.0" class="form-control" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="col-4">Total</th>
                        <td class="col-8">
                            $<span id="total">{{$cambio->total}}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



</div>