@section('purchases-active', 'active')
@section('list_purchases', 'active')
@section('purchases', 'show')
@extends('layouts.backend.app',[
    'title' => 'List Purchases',
    'pageTitle' => 'List Purchases',
])
@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
<style>
    #modal-dialog {
        max-width: 1000px;
        margin: 1.75rem auto;
    }
    </style>
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <a href="/purchases/create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Purchases</a>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date</th>
                        <th>Reference</th>
                        <th>Supplier</th>
                        <th>Warehouse</th>
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Shipping</th>
                        <th>GrandTotal</th>
                        <th>Payment</th>
                        <th>Action</th>
                        <th hidden>supplier_email</th>
                        <th hidden>supplier_address</th>
                        <th hidden>supplier_phone</th>
                        <th hidden>id</th>
                        <th hidden>country</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($purchases as $row)
                        <tr>
                        <th scope="row"  width="1%">{{$loop->iteration}}</th>
                        <td>{{$row->created_at}}</td>
                        <td id="view" value="{{$row->id}}">{{$row->reference_no}}</td>
                        <td id="view" value="{{$row->id}}">{{$row->supplier_name->name}}</td>
                        <td id="view" value="{{$row->id}}">{{$row->warehouse_name->name}}</td>
                        <td id="view" value="{{$row->id}}">{{$row->total}}</td>
                        <td id="view" value="{{$row->id}}">{{$row->total_discount}}</td>
                        <td id="view" value="{{$row->id}}">{{$row->shipping}}</td>
                        <td id="view" value="{{$row->id}}">{{$row->grand_total}}</td>
                        <td id="view" value="{{$row->id}}">{{$row->payment_name->name}}</td>
                        <td style="text-align: center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a data-toggle="modal" id="view" value="{{$row->id}}" class="btn btn-info btn-sm mr-1"><i class="fas fa-eye"></i></a>
                                <a href="/purchases/{{$row->id}}/edit" class="btn btn-primary btn-sm mr-1"><i class="fas fa-edit"></i></a>
                                <a href="/purchases/{{$row->id}}/question" class="btn btn-danger btn-sm mr-1"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                        <th hidden>{{$row->supplier_name->email}}</th>
                        <th hidden>{{$row->supplier_name->address}}</th>
                        <th hidden>{{$row->supplier_name->phone}}</th>
                        <th hidden>{{$row->id}}</th>
                        <th hidden>{{$row->supplier_name->country}},{{$row->supplier_name->address}},{{$row->supplier_name->city}},{{$row->supplier_name->state}},{{$row->supplier_name->postal_code}}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<div class="modal fade" id="modal_view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" id="modal-dialog">
      <div class="modal-content" >
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Purchases Invoice</h5>
      
          <a href="/purchases/view/" target="_blank" class="btn btn-info btn-sm"  id="sila"> <i class="far fa-file-alt"></i> Print</a>
          
        </div>
        <div class="modal-body" id="info">
            <div class="form-group">
                <div class="row invoice-info">
                    <div class="col-sm-6 invoice-col">
                      <address>
                        <span><b>Supplier</b>: <span id="supplier" value=""></span></span><br>
                        <span><b>Email</b>: <span id="supplier_email" value=""></span></span><br>
                        <span><b>Address</b>: <span id="supplier_address" value=""></span></span><br>
                        <span><b>Tel</b>: <span id="supplier_phone" value=""></span></span><br>
                    </div>
                    <div class="col-sm-6 invoice-col">
                        <span><b>Date</b>: <span id="date" value=""></span></span><br>
                        <span><b>Reference</b>: <span id="reference" value=""></span></span><br>
                        <span><b>Warehouses</b>: <span id="warehouse" value=""></span></span><br>
                        <span><b>Payment</b>: <span id="payment" value=""></span></span><br>
                    </div>
                    <!-- /.col -->
                  </div>
                <div class="table-responsive">
                    <table id="viewTable" class="table table-bordered"  width="100%" cellspacing="0">
                        <thead style=" background-color:#36b9cc;color: #000000b8 ;text-align:center">
                            <tr>
                                <th>No</th>
                                <th>Product (Code - Name)</th>
                                <th>Net Unit Cost</th>
                                <th>Quantity</th>
                                <th>Discount</th>
                                <th>Tax</th>
                                <th>Type</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="tbody" style="text-align:center">
                        </tbody>
                    </table>
                </div>
                
            </div>
            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods</p>
                  <img src="/images/credit/visa.png" alt="Visa">
                  <img src="/images/credit/mastercard.png" alt="Mastercard">
                  <img src="/images/credit/american-express.png" alt="American Express">
                  <img src="/images/credit/paypal2.png" alt="Paypal">
          
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    A purchase order is a commercial document and first official offer issued by a buyer to a seller indicating types, quantities and agreed prices for products or services. It is used to control the purchasing of products and services from external suppliers.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <div class="table-responsive">
                    <table class="table">
                      <tbody><tr>
                        <th style="width:50%" >Total:</th>
                        <td id="total" value=""></td>
                      </tr>
                      <tr>
                        <th>Tax</th>
                        <td>$0.00</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td id="shipping" value=""></td>
                      </tr>
                      <tr>
                        <th>GrandTotal:</th>
                        <td id="grandtotal" value=""></td>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
        </div>

      </div>
    </div>
</div>
@stop

@push('js')
<script type="text/javascript">

    $(document).ready(function(){
        var table = $('#dataTable').DataTable();
        table.on('click','#view',function(){
            $tr = $(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr = $tr.prev('.parent') ;
            }
            var data = table.row($tr).data();
            var id = data[14];
            $('#date').text(data[1]);
            $('#reference').text(data[2]);
            $('#warehouse').text(data[4]);
            $('#payment').text(data[9]);
            $('#supplier').text(data[3]);
            $('#supplier_email').text(data[11]);
            $('#supplier_address').text(data[15]);
            $('#supplier_phone').text(data[13]);
            $('#shipping').text('$'+ parseFloat(data[7]).toFixed(2));
            $('#total').text('$'+ parseFloat(data[5]).toFixed(2));
            $('#grandtotal').text('$'+ parseFloat(data[8]).toFixed(2));
            $("#sila").attr('href','/purchases/view/'+data[14]);
            $.ajax({
                url:"/api/purchases/where/"+id,
                type: 'get',
                dataType: "json",
                cache: false,
                success: function( data ) {
                id_row = 0
                $.each(data,function(index,row){
                id_row++
                    $('#viewTable tbody').append("<tr>"
                    +"<td>"+id_row+"</td>"
                    +"<td>"+row.label+"</td>"
                    +"<td>"+row.cost+"</td>"
                    +"<td>"+row.quantity+"</td>"
                    +"<td>"+row.discount+"</td>"
                    +"<td>"+row.tax+"</td>"
                    +"<td>"+row.type+"</td>"
                    +"<td>"+row.subtotal+"</td>"+
                    "</tr>")
                }) 
                },
            });
            $('#modal_view').modal('show');
            $('#viewTable tbody').empty();
            $('#tbody').empty();
        })
    });
</script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>
@endpush