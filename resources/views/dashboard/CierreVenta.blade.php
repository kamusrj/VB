@extends('layouts.master')

@section('title', 'Cierre de venta')

@section('content')

<div class="containe">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Venta</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Documentos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Cambio</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#return-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Devolución</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0"><br>

                    <div class="row">
                        <div class="col">
                            <form method="post" action="">
                                @include('errorMj')
                                @csrf
                                <input type="number" name="id_venta" hidden value="">

                                <div class="row">
                                    <div class="col-md-4">
                                        <table class="table table-bordered caption-top">
                                            <caption>
                                                <h5>Reporte de venta</h5>
                                            </caption>
                                            <tbody>
                                                <tr>
                                                    <th scope="row" class="col-4">$0.01</th>
                                                    <td class="col-8">
                                                        <input type="number" value="0" data-denominacion="0.01" step="1" oninput="calcularTotal()" name="centavo_uno" class="form-control">
                                                    </td>

                                                    <td id="total_input_centavo_uno">$ 0.00</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$0.05</th>
                                                    <td class="col-8">
                                                        <input type="number" value="0" data-denominacion="0.05" step="1" oninput="calcularTotal()" name="centavo_cinco" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$0.10</th>
                                                    <td class="col-8">
                                                        <input type="number" value="0" data-denominacion="0.1" step="1" oninput="calcularTotal()" name="centavo_diez" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$0.25</th>
                                                    <td class="col-8">
                                                        <input type="number" value="0" data-denominacion="0.25" step="1" oninput="calcularTotal()" name="centavo_veinticinco" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$1.00</th>
                                                    <td class="col-8">
                                                        <input type="number" value="0" data-denominacion="1.0" step="1" oninput="calcularTotal()" name="dolar_uno" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$5.00</th>
                                                    <td class="col-8">
                                                        <input type="number" value="0" data-denominacion="5.0" step="1" oninput="calcularTotal()" name="dolar_cinco" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$10.00</th>
                                                    <td class="col-8">
                                                        <input type="number" value="0" data-denominacion="10.0" step="1" oninput="calcularTotal()" name="dolar_diez" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$20.00</th>
                                                    <td class="col-8">
                                                        <input type="number" value="0" data-denominacion="20.0" step="1" oninput="calcularTotal()" name="dolar_veinte" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$50.00</th>
                                                    <td class="col-8">
                                                        <input type="number" value="0" data-denominacion="50.0" step="1" oninput="calcularTotal()" name="dolar_cincuenta" class="form-control">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" class="col-4">$100.00</th>
                                                    <td class="col-8">
                                                        <input type="number" value="0" data-denominacion="100.0" step="1" oninput="calcularTotal()" name="dolar_cien" class="form-control">
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

                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">

                </div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">

                </div>
                <div class="tab-pane fade" id="return-tab-pane" role="tabpanel" aria-labelledby="return-tab" tabindex="0">

                </div>

            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
@endsection

@section('script')
<script>
    function calcularSubtotal(inputElement) {
     
        var denominacion = parseFloat(inputElement.getAttribute('data-denominacion'));

        //
        var cantidad = parseFloat(inputElement.value);

      
        var subtotal = denominacion * cantidad;

    
        var totalCell = document.getElementById('total_input_centavo_uno');
        totalCell.textContent = '$ ' + subtotal.toFixed(2); 
</script>

@endsection