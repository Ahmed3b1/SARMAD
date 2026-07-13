@extends('admin.adminmaster')

@section('content')

    <div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Add</span> Subcategory</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12 mb-5 mb-lg-0">
					<div class="form-title">
					</div>
				 	<div id="form_status"></div>
					<div class="contact-form">
						<form method="POST" enctype="multipart/form-data" action="{{ route('adminstoresubcategory') }}" id="fruitkha-contact">
                            @csrf

							<p>
                                <select class="form-control form-control-lg" required name="category_id" id="category_id">
                                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>اختر القسم الرئيسي</option>

                                    @foreach($allcategories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <span class="text-danger">
                                    @error('category_id')
                                        {{ $message }}
                                    @enderror
                                </span>
							</p>

							<p>
                                <input class="form-control form-control-lg" type="text" required placeholder="Name" name="name"
                                    id="name" value="{{old('name')}}" aria-label=".form-control-lg example">

                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
							</p>

							<p>
                                <input class="form-control form-control-lg" type="text" required placeholder="Slug" name="slug"
                                    id="slug" value="{{old('slug')}}" aria-label=".form-control-lg example">

                                <span class="text-danger">
                                    @error('slug')
                                        {{ $message }}
                                    @enderror
                                </span>
							</p>

							<p>
                                <input class="form-control form-control-lg" type="text" required placeholder="Sort Order" name="sort_order"
                                    id="sort_order" value="{{old('sort_order')}}" aria-label=".form-control-lg example">

                                <span class="text-danger">
                                    @error('sort_order')
                                        {{ $message }}
                                    @enderror
                                </span>
							</p>

							{{-- <p>
                                <textarea class="form-control" id="description" name="description" required
                                      rows="3" placeholder="Description">{{old('description')}}</textarea>
                            </p>
                            <span class="text-danger">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                            </span> --}}

                            <p>
                                <textarea class="form-control" id="quote" name="quote" required
                                      rows="3" placeholder="Quote">{{old('quote')}}</textarea>
                            </p>
                            <span class="text-danger">
                                    @error('quote')
                                        {{ $message }}
                                    @enderror
                            </span>

							<p>
                                <button class="btn btn-primary mb-3" type="submit">Add Subcategory</button>
                            </p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
