const imageInput = document.getElementById('image');
if (imageInput) {
    imageInput.addEventListener('change', function(e) {
        const filenameSpan = document.getElementById('compactFilename');
        if (e.target.files.length > 0) {
            filenameSpan.textContent = e.target.files[0].name;
        } else {
            filenameSpan.textContent = '';
        }
    });
}

const ideFiles = document.querySelectorAll('.ide-file');
if (ideFiles.length > 0) {
    ideFiles.forEach(file => {
        file.addEventListener('click', function() {
            const target = this.dataset.file;

            document.querySelectorAll('.ide-file').forEach(f => f.classList.remove('active'));
            this.classList.add('active');

            document.querySelectorAll('.ide-code').forEach(code => code.classList.add('hidden'));
            document.getElementById('ide-' + target).classList.remove('hidden');

            const pathEl = document.querySelector('.ide-window .path');
            if (pathEl) {
                pathEl.textContent = '~/portfolio/' + target;
            }
        });
    });
}

(function(){
  const driftCanvas = document.getElementById('bg-drift');
  if (!driftCanvas) return;

  const ctx = driftCanvas.getContext('2d');
  driftCanvas.width = window.innerWidth;
  driftCanvas.height = window.innerHeight;

  const snippets = [
    "<?php", "namespace App\\Http\\Controllers;",
"class PostController extends Controller",
"public function index()", "public function store(Request $request)",
"return view('posts.index')", "Post::create([...])",
"Post::find($id)", "$request->validate([...])",
"Route::get('/posts', ...)", "Route::post('/posts', ...)",
"use Illuminate\\Http\\Request;", "$fillable = [...]",
"protected $guarded = []", "Schema::table('posts', ...)",
"$table->string('title')", "$table->foreignId('user_id')",
"php artisan migrate", "php artisan make:model Post -m",
"php artisan make:controller", "php artisan tinker",
"composer require ...", "->hasMany(Comment::class)",
"->belongsTo(User::class)", "@foreach ($posts as $post)",
"@csrf", "{{ $post->title }}", "SELECT * FROM posts",
"WHERE user_id = ?", "public function up(): void",
"$table->timestamps()", "Auth::id()", "redirect()->route(...)",
"$posts = Post::paginate(6)", "storage/app/public",
"artisan storage:link",
"php artisan serve", "php artisan route:list",
"php artisan cache:clear", "php artisan make:middleware",
"php artisan make:seeder", "php artisan db:seed",
"$table->softDeletes()", "use SoftDeletes;",
"Post::withTrashed()->get()", "->middleware('auth')",
"Gate::define('update-post', ...)",
"$this->authorize('update', $post)",
"Storage::disk('public')->put(...)",
"$request->file('image')->store(...)",
"Mail::to($user)->send(...)",
"dispatch(new SendEmailJob($user))",
"Cache::remember('key', 60, fn()=>...)",
"Log::info('message', $data)",
"->with('success', 'Saqlandi!')",
"session()->flash('error', ...)",
"@auth ... @endauth",
"@can('update', $post) ... @endcan",
"{{ old('title') }}",
"php artisan make:request StorePostRequest"
  ];

  const items = Array.from({length: 26}, () => ({
    x: Math.random() * driftCanvas.width,
    y: driftCanvas.height + Math.random() * driftCanvas.height,
    speed: 0.7 + Math.random() * 0.9,
    text: snippets[Math.floor(Math.random() * snippets.length)],
    size: 11 + Math.random() * 7
  }));

  function draw(){
    ctx.clearRect(0, 0, driftCanvas.width, driftCanvas.height);
    items.forEach(item => {
      item.y -= item.speed;
      if (item.y < -20){
        item.y = driftCanvas.height + 20;
        item.x = Math.random() * driftCanvas.width;
      }
      ctx.font = item.size + 'px monospace';
      ctx.fillStyle = '#ffffff71';
      ctx.fillText(item.text, item.x, item.y);
    });
    requestAnimationFrame(draw);
  }
  draw();

  window.addEventListener('resize', () => {
    driftCanvas.width = window.innerWidth;
    driftCanvas.height = window.innerHeight;
  });
})();