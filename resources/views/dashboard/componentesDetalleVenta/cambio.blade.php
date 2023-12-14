<div class="container">
    <div class="row">
        <div class="col-md-5">
            <br>
            @if (in_array(auth()->user()->rol, ['a', 'g', 'c']))
            <button type="button" class="btn btn-primary" style="background-color: #34ac54; border: none;" data-bs-toggle="modal" data-bs-target="#modalCrear">
                <i class="fa-regular fa-pen-to-square"></i> Actualizar
            </button>
            <br>
            @endif
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
                            <input type="number" value="{{$cambio->centavo_diez}}" data-denominacion="0.1" class="form-control" readonly>
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
                            $<span id="total">0.0</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="modalCrear" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: white;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarTitle">Actualizar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('panel/actualizarCambio') }}" method="post">
                        @csrf

                        <input name="id_venta" value="{{$id}}" hidden>

                        <input name="tipo" value="c" hidden>
                        <table class="table table-bordered caption-top ">
                            <caption>
                                <h5>Denominacion</h5>
                            </caption>
                            <tbody>
                                <tr>
                                    <th scope="row" class="col-4">$0.01</th>
                                    <td class="col-8">
                                        <input type="number" value="{{$cambio->centavo_uno}}" class="form-control" name="centavo_uno">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-4">$0.05</th>
                                    <td class="col-8">
                                        <input type="number" value="{{$cambio->centavo_cinco}}" class="form-control" name="centavo_cinco">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-4">$0.10</th>
                                    <td class="col-8">
                                        <input type="number" value="{{$cambio->centavo_diez}}" class="form-control" name="centavo_diez">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-4">$0.25</th>
                                    <td class="col-8">
                                        <input type="number" value="{{$cambio->centavo_veinticinco}}" class="form-control" name="centavo_veinticinco">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-4">$1.00</th>
                                    <td class="col-8">
                                        <input type="number" value="{{$cambio->dolar_uno}}" class="form-control" name="dolar_uno">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-4">$5.00</th>
                                    <td class="col-8">
                                        <input type="number" value="{{$cambio->dolar_cinco}}" class="form-control" name="dolar_cinco">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-4">$10.00</th>
                                    <td class="col-8">
                                        <input type="number" value="{{$cambio->dolar_diez}}" class="form-control" name="dolar_diez">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-4">$20.00</th>
                                    <td class="col-8">
                                        <input type="number" value="{{$cambio->dolar_veinte}}" class="form-control" name="dolar_veinte">
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        
                        <div class="col-12 mb-3 g-1">
                            <button class="w-100 btn btn-success" type="submit">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>