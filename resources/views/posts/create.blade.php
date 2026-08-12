<x-layout title="Post yaratish">
    <section class="page-header">
        <div class="prompt">touch new_post.md</div>
        <h1>Yangi post yaratish</h1>
        <p>Yangi blog postini shu yerdan qo'shing.</p>
    </section>

    <div class="create-post-wrap">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="post-form">
            @csrf
            <div class="form-group">
                <label for="title">sarlavha</label>
                <input type="text" id="title" name="title" placeholder="Post sarlavhasi"
                    value="{{ old('title') }}">
                @error('title')
                    <div class="compact-hint">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="short_body">xulosa</label>
                <input type="text" id="short_body" name="short_body" placeholder="Kichik xulosa"
                    value="{{ old('short_body') }}">
               @error('type_body')
                    <div class="compact-hint">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="type_body">mavzu</label>
                <select id="type_body" name="type_body">
                    <option value="" disabled selected>Mavzuni tanlang</option>
                    <option value="Laravel">Laravel</option>
                    <option value="PHP">PHP</option>
                    <option value="MySQL">MySQL</option>
                    <option value="Docker">Docker</option>
                    <option value="Git">Git</option>
                    <option value="Boshqa">Boshqa</option>
                </select>
                @error('short_body')
                    <div class="compact-hint">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">rasm</label>
                <div class="compact-upload">
                    <span class="upload-btn">Faylni tanlash</span>
                    <span class="compact-filename" id="compactFilename"></span>
                    <input type="file" id="image" name="image" accept="image/*" class="compact-upload-input">
                </div>
                @error('image')
                    <div class="compact-hint">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="body">matn</label>
                <textarea id="body" name="body" placeholder="Post matnini shu yerga yozing..." value="{{ old('body') }}"></textarea>
                @error('body')
                    <div class="compact-hint">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-post">Postni saqlash</button>
                <a href="{{ route('posts.index') }}" class="btn-outline">Bekor qilish</a>
            </div>

        </form>
    </div>
</x-layout>
