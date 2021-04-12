@php /** @var \App\Models\BlogPost $item */ @endphp
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Published
                @else
                    Draft
                @endif
            </div>
            <div class="card-body">
                <div class="card-title"></div>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" role="tab" href="#maindata">Primary data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" role="tab" href="#adddata">Additional data</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input name="title" value="{{ $item->title }}" id="title" type="text"
                                   class="form-control" minlength="3" required>
                        </div>

                        <div class="form-group">
                            <label for="content-raw">Article</label>
                            <textarea name="content_raw" id="content-raw"
                                      class="form-control" rows="20">{{ old('content_raw', $item->content_raw) }}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane" id="adddata" role="tabpanel">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id" id="category_id" type="text"
                                    class="form-control">
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                            @if($categoryOption->id === $item->category_id) selected @endif>
                                        {{ $categoryOption->id_title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input name="slug" value="{{ $item->slug }}" id="slug" type="text"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="excerpt">Excerpt</label>
                            <textarea name="excerpt" id="excerpt"
                                      class="form-control" rows="5">{{ old('excerpt', $item->excerpt) }}</textarea>
                        </div>

                        <div class="form-check">
                            <input type="hidden" name="is_published" value="0">

                            <input type="checkbox"
                                   id="is_published"
                                   name="is_published"
                                   class="form-check-input"
                                   value="1"
                                   @if($item->is_published)
                                       checked
                                   @endif
                            >
                            <label for="is_published">Published</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
