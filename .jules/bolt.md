## 2023-10-25 - [Spatie MediaLibrary N+1 bottleneck]
**Learning:** Calling `getMedia()` on models inside a loop without eager loading the `media` relationship causes a severe N+1 query performance bottleneck because Spatie MediaLibrary issues separate queries for each model's media.
**Action:** Always eager load the `media` relationship using `with('media')` when retrieving collections of models that will have their media accessed, especially in loops.
