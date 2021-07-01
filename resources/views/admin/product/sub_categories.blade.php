<!-- <optgroup label="{{$category->name}}"> -->
                       @foreach($category->sub_categories as $child)
                            <option value="{{ $child ->id }}"
                            	@if($edit && $child->id==$product->category_id)
                            		selected
                            	@endif

                            	>
                                --------{{ $child ->name }} 
                            </option>

                            @if($child->has_children())
					            @include('admin.product.sub_categories',['category' => $child])
					        @endif
                        @endforeach
<!-- </optgroup> -->