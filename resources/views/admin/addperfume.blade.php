@extends('admin.adminmaster')

@section('content')

    <div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Add</span> perfume</h3>
						<p>                  </p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12 mb-5 mb-lg-0">
					<div class="form-title">
					</div>
				 	<div id="form_status"></div>
					<div class="contact-form">
						<form method="POST" enctype="multipart/form-data" action="{{ route('adminstoreitem') }}" id="fruitkha-contact" >
                            @csrf()
							<p>
                                <input class="form-control form-control-lg" type="text" required placeholder="Name" name="name"
                                    id="name" value="{{old('name')}}" aria-label=".form-control-lg example">

                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
							</p>

							<p style="display: flex; ">

                               <input class="form-control form-control-lg" style="width: 50%;" type="number" required placeholder="Price" name="price"
                                    id="price" value="{{old('price')}}" aria-label=".form-control-lg example">


                                <span class="text-danger">
                                    @error('price')
                                        {{ $message }}
                                    @enderror
                                </span>



                                <input class="form-control form-control-lg" type="number" style="width: 50%;" required placeholder="Quantity" name="quantity"
                                    id="quantity" value="{{old('quantity')}}" aria-label=".form-control-lg example">

                                <span class="text-danger">
                                    @error('quantity')
                                        {{ $message }}
                                    @enderror
                                </span>
							</p>

							<p>
                                <textarea class="form-control" id="description" name="description" required
                                      rows="3" placeholder="Description">{{old('description')}}</textarea>
                            </p>
                            <span class="text-danger">
                                    @error('description')
                                        {{ $message }}
                                    @enderror
                            </span>


                            <div class="mb-3">
								<p>
                                    <select class="form-select" required name="category_id" id="category_id" aria-label="Disabled select example" >
                                        {{-- <option selected>Category...</option> --}}
                                        <option value="" disabled selected>اختر القسم الرئيسي</option>
                                        @foreach ($allcategories as $item)
                                            <option value="{{ $item -> id }}">{{ $item -> name }}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <span class="text-danger">
                                        @error('category_id')
                                            {{ $message }}
                                        @enderror
                                </span>
							</div>

                            <div class="mb-3">
                                <p>
                                    <select class="form-select" required name="subcategory_id" id="subcategory_id" aria-label="Disabled select example">
                                        <option value="" disabled selected>اختر القسم الفرعي</option>
                                    </select>
                                </p>
                                <span class="text-danger">
                                    @error('subcategory_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>


                            <div class="input-group mb-3">
                                <input class="form-control" id="photo" name="photo" type="file">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                            </div>

                            <span class="text-danger">
                                    @error('photo')
                                        {{ $message }}
                                    @enderror
                            </span>

							<p>
                                <button class="btn btn-primary mb-3" type="submit">Add Perfume</button>
                            </p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


@endsection

 @section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const categorySelect = document.getElementById('category_id');
            const subcategorySelect = document.getElementById('subcategory_id');

            categorySelect.addEventListener('change', function () {

                const categoryId = this.value;

                // تصفير الـ select الفرعي قبل التحميل
                subcategorySelect.innerHTML = '<option value="" disabled selected>جاري التحميل...</option>';

                if (!categoryId) {
                    subcategorySelect.innerHTML = '<option value="" disabled selected>اختر القسم الفرعي</option>';
                    return;
                }

                fetch(`/admin/get-subcategories/${categoryId}`)
                    .then(response => response.json())
                    .then(data => {

                        if (data.length === 0) {
                            subcategorySelect.innerHTML = '<option value="" disabled selected>لا توجد أقسام فرعية</option>';
                            return;
                        }

                        let options = '<option value="" disabled selected>اختر القسم الفرعي</option>';

                        data.forEach(subcategory => {
                            options += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                        });

                        subcategorySelect.innerHTML = options;

                    })
                    .catch(error => {
                        console.error('Error fetching subcategories:', error);
                        subcategorySelect.innerHTML = '<option value="" disabled selected>حدث خطأ في التحميل</option>';
                    });

            });

        });
    </script>
 @endsection
