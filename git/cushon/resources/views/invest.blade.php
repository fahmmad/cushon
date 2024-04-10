@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Investment') }}</div>
                <form method="post" action="{{ route('invest.save') }}">
                @csrf
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="product_id"">{{ __('Choose a fund') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" name="product_id" id="product_id">
                                <option>Choose a Fund</option>
                                @foreach($funds as $product)
                                    <option value="{{ $product->id }}" @if($productId == $product->id) selected @endif>{{ $product->name }}</option>
                                @endforeach
                            </select>

                            @error('product_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @if($productId)
                    <div class="row mb-3">
                        <label for="amount"">{{ __('How much you would like to invest') }}</label>

                        <div class="col-md-6">
                            <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" required autocomplete="amount" autofocus>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-offset-9 text-end">
                            <button type="submit" id="submit" class="btn btn-primary">
                                Apply
                            </button>
                        </div>    
                    </div>
                    @endif 
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
window.addEventListener('load', function() {
    $('#product_id').on("change", function() {
        window.location = "{{ route('invest') }}/" + $(this).val();
    });
});
</script>