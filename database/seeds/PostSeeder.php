<?php

/**
 * Created by PhpStorm.
 * User: dungnt
 * Date: 9/20/15
 * Time: 10:45 AM
 */
class PostSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        DB::table('posts')->delete();
        $posts = [
            [
                'title' => 'Liên Khúc Nhạc Trẻ Remix Hay Nhất 2015',
                'code' => randomString(8),
                'youtube_id' => '40qlQUJjOWI',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Liên Khúc Nhạc Trẻ Remix Hay Nhất 2015'),
                'active' => true
            ],
            [
                'title' => 'Tuyển Tập Những Bài Hát Hay Nhất Của Bùi Anh Tuấn',
                'code' => randomString(8),
                'youtube_id' => 'iWXesVASO1A',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Tuyển Tập Những Bài Hát Hay Nhất Của Bùi Anh Tuấn'),
                'active' => true
            ],
            [
                'title' => 'Video chỉ trong 4 phút nhưng khiến hàng triệu trái tim rớt nước mắt',
                'code' => randomString(8),
                'youtube_id' => 'Em8AQzHj4fE',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Video chỉ trong 4 phút nhưng khiến hàng triệu trái tim rớt nước mắt'),
                'active' => true
            ],
            [
                'title' => 'LMHT: Tuyển tập Đồng Đoàn – Chat all dụ hàng!',
                'code' => randomString(8),
                'youtube_id' => 'm_l6_ngB58U',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('LMHT: Tuyển tập Đồng Đoàn – Chat all dụ hàng!'),
                'active' => true
            ],
            [
                'title' => '[Live] Ưng Hoàng Phúc - Tuấn Hưng - Duy Mạnh',
                'code' => randomString(8),
                'youtube_id' => '4xlrXXbKRsM',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('[Live] Ưng Hoàng Phúc - Tuấn Hưng - Duy Mạnh'),
                'active' => true
            ],
            [
                'title' => 'Đây là cách người ta sơn màu cho những chiếc guitar. Sáng tạo thật (y)',
                'code' => randomString(8),
                'youtube_id' => 'rmSV2l6JFt0',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Đây là cách người ta sơn màu cho những chiếc guitar. Sáng tạo thật (y)'),
                'active' => true
            ],
            [
                'title' => 'Doreamon - Sinh nhật nguy hiểm của Nobita',
                'code' => randomString(8),
                'youtube_id' => 'SgXJJJYApXo',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Doreamon - Sinh nhật nguy hiểm của Nobita'),
                'active' => true
            ],
            [
                'title' => 'Cận cảnh khả năng hút máu cực nhanh của muỗi',
                'code' => randomString(8),
                'youtube_id' => 'psTq8lnV1lo',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Cận cảnh khả năng hút máu cực nhanh của muỗi'),
                'active' => true
            ],
            [
                'title' => 'Chuyện gì đang xảy ra vậy? Đá gãy chân đối thủ đang là phong trào khắp thế giới chăng?',
                'code' => randomString(8),
                'youtube_id' => '4Gyf2CCT6js',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Chuyện gì đang xảy ra vậy? Đá gãy chân đối thủ đang là phong trào khắp thế giới chăng?'),
                'active' => true
            ],
            [
                'title' => 'Hài Hoài Linh, Trường Giang : Giang hồ Đại Chiến',
                'code' => randomString(8),
                'youtube_id' => 'jpujSPoVoxk',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Hài Hoài Linh, Trường Giang : Giang hồ Đại Chiến'),
                'active' => true
            ],
            [
                'title' => 'Cách gọt táo nhanh nhất',
                'code' => randomString(8),
                'youtube_id' => 'L5YRRLqgYr0',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Cách gọt táo nhanh nhất'),
                'active' => true
            ],
            [
                'title' => 'Chú chó nhất định đòi chủ ôm vì tâm trạng đang không vui',
                'code' => randomString(8),
                'youtube_id' => '2y0F6UU0NUo',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Chú chó nhất định đòi chủ ôm vì tâm trạng đang không vui'),
                'active' => true
            ],
            [
                'title' => 'Trai Ngoan TV - Cho vay tiền và cái kết bất ngờ',
                'code' => randomString(8),
                'youtube_id' => 'Mwzs1TwFiG4',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Trai Ngoan TV - Cho vay tiền và cái kết bất ngờ'),
                'active' => true
            ],
            [
                'title' => 'Anh em đi mua điện thoại vào đây xem để biết mánh khóe của gian thương',
                'code' => randomString(8),
                'youtube_id' => 'hFvGeKUdcn0',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Anh em đi mua điện thoại vào đây xem để biết mánh khóe của gian thương'),
                'active' => true
            ],
            [
                'title' => 'Côn Luân Tam Thánh Hà Túc Đạo giao thủ với Giác Viễn Thiền Sư. Từ đó, ông không còn tự nhận mình là Tam Thánh nữa!',
                'code' => randomString(8),
                'youtube_id' => 'wBfzpuYcoGk',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Côn Luân Tam Thánh Hà Túc Đạo giao thủ với Giác Viễn Thiền Sư. Từ đó, ông không còn tự nhận mình là Tam Thánh nữa!'),
                'active' => true
            ],
            [
                'title' => 'Dành cho những ai đang cô đơn và buồn chán!',
                'code' => randomString(8),
                'youtube_id' => 'RKD4Eh-nJww',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Dành cho những ai đang cô đơn và buồn chán!'),
                'active' => true
            ],
            [
                'title' => 'Chỉ là trẻ con thôi ...nhưng mà nhìn mặt nó thích quá',
                'code' => randomString(8),
                'youtube_id' => 'FDySW1fVFXo',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Chỉ là trẻ con thôi ...nhưng mà nhìn mặt nó thích quá'),
                'active' => true
            ],
            [
                'title' => 'Đừng bỏ vỏ chanh sau khi vắt nữa, vì nó giúp bạn không bao giờ phải gặp bác sĩ đó',
                'code' => randomString(8),
                'youtube_id' => 'zMuts2knLlY',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('Đừng bỏ vỏ chanh sau khi vắt nữa, vì nó giúp bạn không bao giờ phải gặp bác sĩ đó'),
                'active' => true
            ],
            [
                'title' => '2 giờ Nhạc cho bé ngủ ngon, phát triển trí thông minh, năng động và hoạt bát',
                'code' => randomString(8),
                'youtube_id' => 'InZXBi_KVVU',
                'type' => \App\Funny\Models\Post::VIDEO_TYPE,
                'user_id' => 1,
                'slug' => \Illuminate\Support\Str::slug('2 giờ Nhạc cho bé ngủ ngon, phát triển trí thông minh, năng động và hoạt bát'),
                'active' => true
            ]
        ];
        DB::table('posts')->insert($posts);
    }

}