@php /* @var \App\Models\BlogCategory $item */@endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">Основные сведения</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Заголовок</label>
                            <input type="text" value="{{ $item->title }}"
                                   class="form-control"
                                   id="title"
                                   name="title"
                                   minlength="3"
                                   required>

                        </div>

                        <div class="form-group">
                            <label for="slug">Идентификатор</label>
                            <input type="text" value="{{ $item->slug}}"
                                   class="form-control"
                                   id="slug"
                                   name="slug">

                        </div>
                        <div class="form-group">
                            <label for="parent_id">Выбор родителя</label>
                            <select class="form-control"
                                    id="parent_id"
                                    name="parent_id"
                                    placeholder="Выбрать категорию">
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                    @if($categoryOption->id == $item->id) selected @endif>{{ $categoryOption->title }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="description">Описание</label>
                            <textarea class="form-control"
                                    id="description"
                                    name="description"
                                    rows="3">{{ old('description', $item->description) }}
                            </textarea>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
