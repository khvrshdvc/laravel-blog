<x-layout title="Edit Post">

    <section class="page-header">
        <div class="prompt">edit post.md</div>
        <h1>Postni tahrirlash</h1>
        <p>{{ $post->id }}-post</p>
    </section>

    <div class="create-post-wrap">

        <form
            action="{{ route('posts.update', ['post' => $post->id]) }}"
            method="POST"
            enctype="multipart/form-data"
            class="post-form"
        >
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="title">sarlavha</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    placeholder="Post sarlavhasi"
                    value="{{ old('title', $post->title) }}"
                >

                @error('title')
                    <div class="compact-hint error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="short_body">xulosa</label>

                <input
                    type="text"
                    id="short_body"
                    name="short_body"
                    placeholder="Kichik xulosa"
                    value="{{ old('short_body', $post->short_body) }}"
                >

                @error('short_body')
                    <div class="compact-hint error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="type_body">mavzu</label>

                <select id="type_body" name="type_body">
                    <option value="" disabled
                        {{ old('type_body', $post->type_body) ? '' : 'selected' }}>
                        Mavzuni tanlang
                    </option>

                    <option value="Laravel"
                        {{ old('type_body', $post->type_body) == 'Laravel' ? 'selected' : '' }}>
                        Laravel
                    </option>

                    <option value="PHP"
                        {{ old('type_body', $post->type_body) == 'PHP' ? 'selected' : '' }}>
                        PHP
                    </option>

                    <option value="MySQL"
                        {{ old('type_body', $post->type_body) == 'MySQL' ? 'selected' : '' }}>
                        MySQL
                    </option>

                    <option value="Docker"
                        {{ old('type_body', $post->type_body) == 'Docker' ? 'selected' : '' }}>
                        Docker
                    </option>

                    <option value="Git"
                        {{ old('type_body', $post->type_body) == 'Git' ? 'selected' : '' }}>
                        Git
                    </option>

                    <option value="Boshqa"
                        {{ old('type_body', $post->type_body) == 'Boshqa' ? 'selected' : '' }}>
                        Boshqa
                    </option>
                </select>

                @error('type_body')
                    <div class="compact-hint error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image">rasm</label>

                @if ($post->image)
                    <div class="current-image-preview">
                        <img
                            src="{{ asset('storage/' . $post->image) }}"
                            alt="Joriy rasm"
                        >

                        <span class="current-image-name">
                            {{ basename($post->image) }}
                        </span>
                    </div>
                @endif

                <div class="compact-upload">
                    <span class="upload-btn">Faylni tanlash</span>

                    <span
                        class="compact-filename"
                        id="compactFilename"
                    ></span>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        class="compact-upload-input"
                    >
                </div>

                @error('image')
                    <div class="compact-hint error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="body">matn</label>

                <textarea
                    id="body"
                    name="body"
                    placeholder="Post matnini shu yerga yozing..."
                >{{ old('body', $post->body) }}</textarea>

                @error('body')
                    <div class="compact-hint error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-post">
                    Postni yangilash
                </button>

                <a
                    href="{{ route('posts.show', $post) }}"
                    class="btn-outline"
                >
                    Bekor qilish
                </a>
            </div>

        </form>
    </div>

</x-layout>
