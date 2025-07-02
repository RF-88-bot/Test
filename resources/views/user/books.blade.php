 @extends('user.layouts.app')


 @section('title', 'Books')
 @section('content')
     <section class="features py-5">
         <div class="container">
             <div class="row">
                 @foreach ($books as $book)
                     @php $delay = $loop->index * 300; @endphp
                     <div class="col-md-3 text-center mb-4" data-aos="fade-in" data-aos-delay="{{ $delay }}">
                         <div class="py-4 px-2  h-100">
                             <img src="{{ asset('storage/' . $book->image) }}" alt="Icon {{ $book->title }}" width="64">
                             <h4 class="element-title text-capitalize my-3">{{ $book->category->category }}</h4>
                             <p>{{ Str::limit($book->category->description, 20) }}</p>
                         </div>
                     </div>
                 @endforeach
             </div>
         </div>
     </section>
 @endsection
