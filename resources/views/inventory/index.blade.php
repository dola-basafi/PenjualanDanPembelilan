@extends('template')
@section('title', 'Inventory')
@section('navName', 'Inventory')
@section('content')
  @if (auth()->user()->role == 2 or auth()->user()->role == 1 and $admin == 'sales')
    @php
      $endpoint = route('saleStore');
    @endphp
  @elseif (auth()->user()->role == 3 or auth()->user()->role == 1 and $admin == 'purchase')
    @php
      $endpoint = route('purchaseStore');
    @endphp
  @else
    @php
      $endpoint = '';
    @endphp
  @endif
  <form action="{{ $endpoint }}" method="post" class="formSubmit mb-2">
    @csrf
    <div class="formContent">
      
    </div>
  </form>


  @if (auth()->user()->role == 1)
    <a href="{{ route('invCreate') }}" class="btn btn-info mb-2">
      Add Data Invientory
    </a>
    <a href="{{ route('adminSalesPurchase','sales') }}" class="btn btn-primary mb-2">
      Sales
    </a>
    <a href="{{ route('adminSalesPurchase','purchase') }}" class="btn btn-success mb-2">
      Purchase
    </a>
    @endif
    @if (auth()->user()->role == 2 or auth()->user()->role == 1)
    <a href="{{ route('salesIndex') }}" class="btn btn-primary mb-2">
      List Sales
    </a>        
    @endif

  <table id="inventory" class="table table-striped">
    <thead>
      <tr>
        <th>Kode</th>
        <th>Nama</th>
        <th>Stock</th>
        <th>Harga</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $item)
        <tr>
          <td>{{ $item->code }}</td>
          <td>{{ $item->name }}</td>
          <td>{{ $item->stock }}</td>
          <td>{{ $item->price }}</td>


          @if (auth()->user()->role == 1 and $admin == '')
            <td>
              <form action="{{ route('indDelete', $item->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">delete</button>
                <a href="{{ route('invEdit', $item->id) }}" class="btn btn-primary">edit</a>
              </form>
            </td>
          @elseif (auth()->user()->role == 2 or (auth()->user()->role == 1 and $admin == 'sales'))
            <td>
              <button
                onclick="data.addCart( '{{ $item->id }}', '{{ $item->code }}',' {{ $item->name }}', '{{ $item->price }}' , '{{ $item->stock }}')">Add
              </button>
            </td>
          @elseif (auth()->user()->role == 3 or (auth()->user()->role == 1 and $admin == 'purchase'))
            <td>
              <button
                onclick="data.addCart( '{{ $item->id }}', '{{ $item->code }}',' {{ $item->name }}', '{{ $item->price }}' , '{{ $item->stock }}')">Add
              </button>
            </td>
          @endif

        </tr>
      @endforeach
    </tbody>
  </table>
  <script>
    new DataTable('#inventory');

    const data = {
      cart: [],
      addCart(id, code, name, price, stock) {
        this.cart = []
        let cek = true
        if (sessionStorage.getItem('cart') != null) {
          this.loadCart()
          for (let x in this.cart) {
            if (this.cart[x].code === code) {
              cek = false
              break
            }
          }
        }
        if (cek) {
          this.cart.push({
            'id': id,
            'code': code,
            'name': name,
            'price': price,
            'stock': stock
          })
          this.saveCart()
        }
      },

      saveCart() {
        sessionStorage.setItem('cart', JSON.stringify(this.cart))
        this.cart = []
        createForm()
      },

      loadCart() {
        this.cart = JSON.parse(sessionStorage.getItem('cart'))
      },

      clearCart() {
        sessionStorage.removeItem('cart')
        createForm()

      }
    }
    data.clearCart()

    function createForm() {
      $(".formContent").empty()
      let cartData = JSON.parse(sessionStorage.getItem('cart'))
      let form = ""
      form += `    
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Kode</th>
            <th scope="col">Stock</th>
            <th scope="col">Name</th>
            <th scope="col">Harga</th>
            <th scope="col">Qty</th>
          </tr>
        </thead>
        <tbody>
             
      `

      for (let x in cartData) {
        form += `        
        <tr>
            <td>
              ${parseInt(x)+1}
            </td> 
        <td>
          <input type="text" name="data[${x}][code]" value="${cartData[x].code}">
        </td>
        <td>
          <input type="number" name="data[${x}][stock]" value="${cartData[x].stock}">
        </td>
        <td>
          <input type="text" name="data[${x}][name]" value="${cartData[x].name}">
        </td>
        <td>
          <input type="number" name="data[${x}][price]" value="${cartData[x].price}">
          <input type="hidden" name="data[${x}][id]" value="${cartData[x].id}">
        </td> 
        <td>
          <input type="text" name="data[${x}][qty]" value="0">
        </td>          
      </tr>
        `
      }


      form += `
      </tbody>  </table>    <button type="submit"  class="btn btn-primary">SUBMIT</button> 
      <p  onclick="data.clearCart()" class="btn btn-danger mb-0">Clear Data</p>
      `

      $(".formContent").append(form)
      if (sessionStorage.getItem('cart') === null) {
        $(".formContent").empty()
      }

    }
    if (sessionStorage.getItem('cart') != null) {
      createForm()
    }
  </script>







@endsection
