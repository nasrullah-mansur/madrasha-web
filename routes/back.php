<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DayController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\ChamberController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Back\BlogController;
use App\Http\Controllers\Back\MenuController;
use App\Http\Controllers\Back\AwardController;
use App\Http\Controllers\CustomPageController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Back\BannerController;
use App\Http\Controllers\BlogSidebarController;
use App\Http\Controllers\SpecialtiesController;
use App\Http\Controllers\Back\BlogTagController;
use App\Http\Controllers\AdvertizementController;
use App\Http\Controllers\Back\TrainingController;
use App\Http\Controllers\ContactSectionController;
use App\Http\Controllers\Back\AppearanceController;
use App\Http\Controllers\Back\TestimonialController;
use App\Http\Controllers\Back\BlogCategoryController;
use App\Http\Controllers\Back\ImageGalleryController;
use App\Http\Controllers\Back\VideoGalleryController;
use App\Http\Controllers\DayTimeController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\GlanceController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\SliderController;

Route::middleware(['auth'])->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // =====================================
    // ======================== Admin Routes 
    // =====================================
    Route::group(['middleware' => ['admin']], function () {

        Route::prefix('admin')->group(function () {

            // Blog Categories;
            Route::get('blog/categories', [BlogCategoryController::class, 'index'])->name('blog.category.index');
            Route::get('blog/category/create', [BlogCategoryController::class, 'create'])->name('blog.category.create');
            Route::post('blog/category/store', [BlogCategoryController::class, 'store'])->name('blog.category.store');
            Route::get('blog/category/edit/{id}', [BlogCategoryController::class, 'edit'])->name('blog.category.edit');
            Route::post('blog/category/update/{id}', [BlogCategoryController::class, 'update'])->name('blog.category.update');
            Route::post('blog/category/delete', [BlogCategoryController::class, 'delete'])->name('blog.category.delete');

            // Blog Tags;
            Route::get('blog/tags', [BlogTagController::class, 'index'])->name('blog.tag.index');
            Route::get('blog/tag/create', [BlogTagController::class, 'create'])->name('blog.tag.create');
            Route::post('blog/tag/store', [BlogTagController::class, 'store'])->name('blog.tag.store');
            Route::get('blog/tag/edit/{id}', [BlogTagController::class, 'edit'])->name('blog.tag.edit');
            Route::post('blog/tag/update/{id}', [BlogTagController::class, 'update'])->name('blog.tag.update');
            Route::post('blog/tag/delete', [BlogTagController::class, 'delete'])->name('blog.tag.delete');

            // Blogs;
            Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
            Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
            Route::post('blog/store', [BlogController::class, 'store'])->name('blog.store');
            Route::get('blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
            Route::post('blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
            Route::post('blog/delete', [BlogController::class, 'delete'])->name('blog.delete');

            // Appearance;
            Route::get('appearance/edit', [AppearanceController::class, 'edit'])->name('appearance.edit');
            Route::post('appearance/update', [AppearanceController::class, 'update'])->name('appearance.update');

            // Menu;
            Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
            Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');
            Route::post('/menu/update/{id}', [MenuController::class, 'update'])->name('menu.update');
            Route::post('/menu/delete', [MenuController::class, 'delete'])->name('menu.delete');

            // Menu Item;
            Route::get('/menu/{slug}', [MenuController::class, 'menuItem'])->name('menuItem.index');
            Route::post('/add/item', [MenuController::class, 'addItem'])->name('menuItem.addItem');
            Route::post('/menu/item/store/{menu_id}', [MenuController::class, 'menuItemStore'])->name('menuItem.store');
            Route::post('/menu/item/update', [MenuController::class, 'menuItemUpdate'])->name('menuItem.update');
            Route::post('/menu/item/delete', [MenuController::class, 'menuItemDelete'])->name('menuItem.delete');

            // Video Gallery Category;
            Route::get('gallery/video/categories', [VideoGalleryController::class, 'index_category'])->name('video_gallery_category.index');
            Route::get('gallery/video/category/create', [VideoGalleryController::class, 'create_category'])->name('video_gallery_category.create');
            Route::post('gallery/video/category/store', [VideoGalleryController::class, 'store_category'])->name('video_gallery_category.store');
            Route::get('gallery/video/category/edit/{id}', [VideoGalleryController::class, 'edit_category'])->name('video_gallery_category.edit');
            Route::post('gallery/video/category/update/{id}', [VideoGalleryController::class, 'update_category'])->name('video_gallery_category.update');
            Route::post('gallery/video/category/delete', [VideoGalleryController::class, 'delete_category'])->name('video_gallery_category.delete');

            // Video Gallery;
            Route::get('gallery/videos', [VideoGalleryController::class, 'index'])->name('video_gallery.index');
            Route::get('gallery/video/create', [VideoGalleryController::class, 'create'])->name('video_gallery.create');
            Route::post('gallery/video/store', [VideoGalleryController::class, 'store'])->name('video_gallery.store');
            Route::get('gallery/video/edit/{id}', [VideoGalleryController::class, 'edit'])->name('video_gallery.edit');
            Route::post('gallery/video/update/{id}', [VideoGalleryController::class, 'update'])->name('video_gallery.update');
            Route::post('gallery/video/delete', [VideoGalleryController::class, 'delete'])->name('video_gallery.delete');

            // Image Gallery Category;
            Route::get('gallery/image/categories', [ImageGalleryController::class, 'index_category'])->name('image_gallery_category.index');
            Route::get('gallery/image/category/create', [ImageGalleryController::class, 'create_category'])->name('image_gallery_category.create');
            Route::post('gallery/image/category/store', [ImageGalleryController::class, 'store_category'])->name('image_gallery_category.store');
            Route::get('gallery/image/category/edit/{id}', [ImageGalleryController::class, 'edit_category'])->name('image_gallery_category.edit');
            Route::post('gallery/image/category/update/{id}', [ImageGalleryController::class, 'update_category'])->name('image_gallery_category.update');
            Route::post('gallery/image/category/delete', [ImageGalleryController::class, 'delete_category'])->name('image_gallery_category.delete');

            // Image Gallery;
            Route::get('gallery/images', [ImageGalleryController::class, 'index'])->name('image_gallery.index');
            Route::get('gallery/image/create', [ImageGalleryController::class, 'create'])->name('image_gallery.create');
            Route::post('gallery/image/store', [ImageGalleryController::class, 'store'])->name('image_gallery.store');
            Route::get('gallery/image/edit/{id}', [ImageGalleryController::class, 'edit'])->name('image_gallery.edit');
            Route::post('gallery/image/update/{id}', [ImageGalleryController::class, 'update'])->name('image_gallery.update');
            Route::post('gallery/image/delete', [ImageGalleryController::class, 'delete'])->name('image_gallery.delete');

            // Subscriber;
            Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscriber.index');
            Route::post('/subscriber/delete', [SubscriberController::class, 'delete'])->name('subscriber.delete');

            // Social;
            Route::get('social', [SocialController::class, 'index'])->name('social.index');
            Route::get('social/create', [SocialController::class, 'create'])->name('social.create');
            Route::post('social/store', [SocialController::class, 'store'])->name('social.store');
            Route::get('social/edit/{id}', [SocialController::class, 'edit'])->name('social.edit');
            Route::post('social/update/{id}', [SocialController::class, 'update'])->name('social.update');
            Route::post('social/delete', [SocialController::class, 'delete'])->name('social.delete');




            // ********************** Sections ********************

            // Banner;
            Route::get('banner', [BannerController::class, 'edit'])->name('banner.edit');
            Route::post('banner', [BannerController::class, 'update'])->name('banner.update');

            // Specialties;
            Route::get('specialties/images', [SpecialtiesController::class, 'index'])->name('specialties.index');
            Route::get('specialties/image/create', [SpecialtiesController::class, 'create'])->name('specialties.create');
            Route::post('specialties/image/store', [SpecialtiesController::class, 'store'])->name('specialties.store');
            Route::get('specialties/image/edit/{id}', [SpecialtiesController::class, 'edit'])->name('specialties.edit');
            Route::post('specialties/image/update/{id}', [SpecialtiesController::class, 'update'])->name('specialties.update');
            Route::post('specialties/image/delete', [SpecialtiesController::class, 'delete'])->name('specialties.delete');


            // Training;
            Route::get('training/images', [TrainingController::class, 'index'])->name('training.index');
            Route::get('training/image/create', [TrainingController::class, 'create'])->name('training.create');
            Route::post('training/image/store', [TrainingController::class, 'store'])->name('training.store');
            Route::get('training/image/edit/{id}', [TrainingController::class, 'edit'])->name('training.edit');
            Route::post('training/image/update/{id}', [TrainingController::class, 'update'])->name('training.update');
            Route::post('training/image/delete', [TrainingController::class, 'delete'])->name('training.delete');

            // Award;
            Route::get('award/images', [AwardController::class, 'index'])->name('award.index');
            Route::get('award/image/create', [AwardController::class, 'create'])->name('award.create');
            Route::post('award/image/store', [AwardController::class, 'store'])->name('award.store');
            Route::get('award/image/edit/{id}', [AwardController::class, 'edit'])->name('award.edit');
            Route::post('award/image/update/{id}', [AwardController::class, 'update'])->name('award.update');
            Route::post('award/image/delete', [AwardController::class, 'delete'])->name('award.delete');

            // Testimonial;
            Route::get('testimonial/images', [TestimonialController::class, 'index'])->name('testimonial.index');
            Route::get('testimonial/image/create', [TestimonialController::class, 'create'])->name('testimonial.create');
            Route::post('testimonial/image/store', [TestimonialController::class, 'store'])->name('testimonial.store');
            Route::get('testimonial/image/edit/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
            Route::post('testimonial/image/update/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');
            Route::post('testimonial/image/delete', [TestimonialController::class, 'delete'])->name('testimonial.delete');

            // Blog sidebar;
            Route::get('blog/sidebar', [BlogSidebarController::class, 'index'])->name('blog.sidebar');
            Route::post('blog/sidebar', [BlogSidebarController::class, 'update'])->name('blog.sidebar.update');


            // Advertizement;
            Route::get('advertizement/images', [AdvertizementController::class, 'index'])->name('advertizement.index');
            Route::get('advertizement/image/create', [AdvertizementController::class, 'create'])->name('advertizement.create');
            Route::post('advertizement/image/store', [AdvertizementController::class, 'store'])->name('advertizement.store');
            Route::get('advertizement/image/edit/{id}', [AdvertizementController::class, 'edit'])->name('advertizement.edit');
            Route::post('advertizement/image/update/{id}', [AdvertizementController::class, 'update'])->name('advertizement.update');
            Route::post('advertizement/image/delete', [AdvertizementController::class, 'delete'])->name('advertizement.delete');

            // Contact Section;
            Route::get('contact/section', [ContactSectionController::class, 'edit'])->name('contact.section');
            Route::post('contact/section', [ContactSectionController::class, 'update'])->name('contact.section.update');


            // ***************** Contact From Contact Form *******************;

            Route::get('contact', [ContactController::class, 'index'])->name('user.contact');
            Route::get('contact/{id}', [ContactController::class, 'show'])->name('user.contact.show');
            Route::post('contact/delete', [ContactController::class, 'delete'])->name('user.contact.delete');
            Route::post('contact/reply', [ContactController::class, 'reply'])->name('user.contact.reply');


            // **************** Appointment ********************************;
            // Route::get('times', [TimeController::class, 'index'])->name('dr.time.index');
            // Route::post('times/store', [TimeController::class, 'store'])->name('dr.time.store');
            // Route::post('times/update', [TimeController::class, 'update'])->name('dr.time.update');
            // Route::post('times/delete', [TimeController::class, 'delete'])->name('dr.time.delete');

            // Route::get('days', [DayController::class, 'index'])->name('dr.day.index');
            // Route::post('days/store', [DayController::class, 'store'])->name('dr.day.store');
            // Route::post('days/update', [DayController::class, 'update'])->name('dr.day.update');
            // Route::post('days/delete', [DayController::class, 'delete'])->name('dr.day.delete');

            // **************** Sliders ********************************;
            Route::get('/sliders', [SliderController::class, 'index'])->name('slider.index');
            Route::get('/sliders/create', [SliderController::class, 'create'])->name('slider.create');
            Route::post('/sliders/store', [SliderController::class, 'store'])->name('slider.store');
            Route::get('/sliders/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
            Route::post('/sliders/update/{id}', [SliderController::class, 'update'])->name('slider.update');
            Route::post('/sliders/delete', [SliderController::class, 'delete'])->name('slider.delete');

            // **************** Divisions ********************************;
            Route::get('/division', [DivisionController::class, 'index'])->name('division.index');
            Route::get('/division/create', [DivisionController::class, 'create'])->name('division.create');
            Route::post('/division/store', [DivisionController::class, 'store'])->name('division.store');
            Route::get('/division/edit/{id}', [DivisionController::class, 'edit'])->name('division.edit');
            Route::post('/division/update/{id}', [DivisionController::class, 'update'])->name('division.update');
            Route::post('/division/delete', [DivisionController::class, 'delete'])->name('division.delete');


            // **************** Notice ********************************;
            Route::get('/notice/edit', [NoticeController::class, 'edit'])->name('notice.edit');
            Route::post('/notice/update', [NoticeController::class, 'update'])->name('notice.update');
            Route::post('/notice/delete', [NoticeController::class, 'delete'])->name('notice.delete');

            // **************** Notice ********************************;
            Route::get('/glance/edit', [GlanceController::class, 'edit'])->name('glance.edit');
            Route::post('/glance/update', [GlanceController::class, 'update'])->name('glance.update');
            Route::post('/glance/delete', [GlanceController::class, 'delete'])->name('glance.delete');


            // **************** Page SEO ********************************;
            Route::get('/page-seos', [SeoController::class, 'index'])->name('page.seo.index');
            Route::get('/page-seo/create', [SeoController::class, 'create'])->name('page.seo.create');
            Route::post('/page-seo/store', [SeoController::class, 'store'])->name('page.seo.store');
            Route::get('/page-seo/edit/{id}', [SeoController::class, 'edit'])->name('page.seo.edit');
            Route::post('/page-seo/update/{id}', [SeoController::class, 'update'])->name('page.seo.update');
            Route::post('/page-seo/delete', [SeoController::class, 'delete'])->name('page.seo.delete');


            // **************** Custom Page ********************************;
            Route::get('/custom-page', [CustomPageController::class, 'index'])->name('custom.page.index');
            Route::get('/custom-page/create', [CustomPageController::class, 'create'])->name('custom.page.create');
            Route::post('/custom-page/store', [CustomPageController::class, 'store'])->name('custom.page.store');
            Route::get('/custom-page/edit/{id}', [CustomPageController::class, 'edit'])->name('custom.page.edit');
            Route::post('/custom-page/update/{id}', [CustomPageController::class, 'update'])->name('custom.page.update');
            Route::post('/custom-page/delete', [CustomPageController::class, 'delete'])->name('custom.page.delete');



        });
    });
});
