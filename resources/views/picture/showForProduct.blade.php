@if($product->pictures->isNotEmpty())
    <div class="row">
        @foreach($product->pictures as $picture)
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="{{ asset(sprintf('%s/%s', config('filesystems.disks.myDisks.storage'), $picture->name )) }}" >
                    <div class="card-body">
                        <form method="post" action="{{ route( 'picture.destroy', [ 'id' => $picture , 'product_id' => $product->id ] ) }}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <a href="{{ asset(config('filesystems.disks.myDisks.storage').'/'.$picture->name) }}" class="btn btn-primary">Download</a>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif