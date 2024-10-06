@extends('layouts.clientnav')

@section('content')

<div class="modal fade" id="receiptModal" tabindex="-1" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiptModalLabel">Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="content">
                        <div class="main text-center">
                            <div class="content-wrap">
                                <div class="content-block">
                                    <h2>Receipt</h2>
                                </div>
                                <div class="content-block">
                                    <table class="table">
                                        <tr class="text-start">
                                            <td>
                                                <span id="customerName">Anna Smith</span>
                                                <br>
                                                <span id="invoiceNo">Invoice #12345</span>
                                                <br>
                                                <span id="date">June 01 2015</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table id="receipItemsTable" class="table">
                                                    <thead>
                                                        <tr class="table-active">
                                                            <td class="text-center">Item</td>
                                                            <td class="text-center">Price</td>
                                                            <td class="text-center">Qty</td>
                                                            <td class="text-center">Subtotal</td>
                                                        </tr>
                                                        <thead>
                                                        <tbody id="receipItemsTableBody">

                                                    <tbody>
                                                    <tfoot>
                                                        <tr class="table-active">
                                                            <td class="text-center fw-bolder">Total</td>
                                                            <td class="text-center fw-bold" colspan="2"></td>
                                                            <td id="totalPrice" class="text-center fw-bold">₱36.00
                                                            </td>
                                                        </tr>
                                                        <tfoot>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="content-block">
                                    OCMIS 2023
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection