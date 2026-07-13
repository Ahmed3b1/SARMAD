@extends('admin.adminmaster')

@section('content')

    <div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Edit</span> Subcategory</h3>
						<p>تعديل بيانات القسم الفرعي</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12 mb-5 mb-lg-0">
					<div class="form-title">
					</div>
				 	<div id="form_status"></div>
					<div class="contact-form">
						<form method="POST" enctype="multipart/form-data" action="{{ route('adminupdatesubcategory', $subcategory->id) }}" id="fruitkha-contact">
                            @csrf

							<p>
                                <select class="form-control form-control-lg" required name="category_id" id="category_id">
                                    <option value="" disabled>اختر القسم الرئيسي</option>

                                    @foreach($allcategories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>
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
                                    id="name" value="{{ old('name', $subcategory->name) }}" aria-label=".form-control-lg example">

                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
							</p>

							<p>
                                <input class="form-control form-control-lg" type="text" required placeholder="Slug" name="slug"
                                    id="slug" value="{{ old('slug', $subcategory->slug) }}" aria-label=".form-control-lg example">

                                <span class="text-danger">
                                    @error('slug')
                                        {{ $message }}
                                    @enderror
                                </span>
							</p>

							<p>
                                <input class="form-control form-control-lg" type="text" required placeholder="Sort Order" name="sort_order"
                                    id="sort_order" value="{{ old('sort_order', $subcategory->sort_order) }}" aria-label=".form-control-lg example">

                                <span class="text-danger">
                                    @error('sort_order')
                                        {{ $message }}
                                    @enderror
                                </span>
							</p>

							<p>
                                <textarea class="form-control" id="quote" name="quote"
                                      rows="3" placeholder="Quote (Optional)">{{ old('quote', $subcategory->quote) }}</textarea>
                            </p>
                            <span class="text-danger">
                                    @error('quote')
                                        {{ $message }}
                                    @enderror
                            </span>

							<p>
                                <button class="btn btn-primary mb-3" type="submit">Update Subcategory</button>
                            </p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
