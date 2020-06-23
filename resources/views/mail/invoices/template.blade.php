@php
function toUSD($amount, $currency = 'USD') {
  $money = new NumberFormatter('en_US', NumberFormatter::CURRENCY);

  return $money->formatCurrency($amount, $currency);
}
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice # {{ $invoice['invoice_number'] }}</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
</head>
<body>
  <div class="container contaier-fluid my-5" id="view-invoice">

    <div class="row">
      <div class="col-sm-12 col-md-6">
        <h6 class="text-muted">Pay To</h6>
        <p>{{ json_encode($invoice['user']) }}</p>
      </div>
      <div class="col-sm-12 col-md-6"></div>
    </div>

    <div class="row">
      <div class="col-sm-12 col-md-6">
        <h6 class="text-muted">Bill To</h6>
        <p>
          @if($invoice['client']['firstname'] || $invoice['client']['lastname'])
            {{ $invoice['client']['firstname'] }} {{ $invoice['client']['lastname'] }}<br />
          @endif
          @if($invoice['client']['company'])
            {{ $invoice['client']['company'] }}<br />
          @endif
          {{ $invoice['client']['address'] }}<br />
          {{ $invoice['client']['city'] }}, {{ $invoice['client']['state'] }} {{ $invoice['client']['zip'] }}<br />
          {{ $invoice['client']['country'] }}<br />
        </p>
      </div>
      <div class="col-sm-12 col-md-6">
        <h6 class="text-muted">Contact</h6>
        <p>
          {{ $invoice['client']['email'] }}<br />
          {{ $invoice['client']['phone'] }}
        </p>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12 col-md-6">
        <h6 class="text-muted">Invoiced Date</h6>
        <p>{{ date('m/d/Y', strtotime($invoice['invoiced_at'])) }}</p>
      </div>
      <div class="col-sm-12 col-md-6">
        <h6 class="text-muted">Due Date</h6>
        <p>{{ date('m/d/Y', strtotime($invoice['due_at'])) }}</p>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Description</th>
              <th>Quantity</th>
              <th>Rate</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach($invoice['line_items'] as $item)
              <tr>
                <td>{{ $item['description'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>{{ toUSD($item['rate']) }}</td>
                <td>{{ toUSD($item['quantity'] * $item['rate']) }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="row">
      
      <div class="col-sm-12 col-md-6 col-lg-4">
        <h6 class="text-muted">Invoice Message</h6>
        <p>{{ $invoice['message'] }}</p>
      </div>

      <div class="col-sm-12 col-md-6 col-lg-8">
        <table class="table table-borderless">
          <tr>
            <th>Discounts</th>
            <td>
              {{ toUSD($invoice['discount']) }}
            </td>
          </tr>
          <tr>
            <th>Taxes</th>
            <td>{{ toUSD($invoice['tax']) }}</td>
          </tr>
          <tr>
            <th>Invoice Amount</th>
            <td>{{ toUSD($invoice['total']) }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</body>
</html>