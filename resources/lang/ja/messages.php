<?php

return [

    /*
    |--------------------------------------------------------------------------
    | アプリケーションメッセージ
    |--------------------------------------------------------------------------
    |
    | 以下の言語行は、アプリケーション全体で使用されるユーザー向け
    | メッセージ（エラー、警告、情報テキスト、その他のプロンプト）
    | です。アプリケーションの要件に合わせて自由に変更できます。
    |
    */

    'invalid_size_format_expect_width_x_height_in_millimeters' => 'サイズ形式が無効です：:size。期待される形式は「幅 x 高（ミリメートル）」です。',
    'invalid_size_values_width_and_height_must_be_greater_than_zero' => 'サイズ値が無効です：:size。幅と高さは0より大きくなければなりません。',
    'quote_rule_not_found_for_model_with_id' => 'モデル :model（ID：:id）の見積ルールが見つかりません。',
    'the_consign_quantity_cannot_be_greater_than_the_total_quantity' => '自己供給数量は総数量を超えることはできません',
    'the_provided_class_does_not_exist_or_is_not_a_valid_subclass_of_model' => '指定されたクラス :class は存在しないか、Model の有効なサブクラスではありません。',
    'the_total_quantity_must_be_equal_to_qty_per_multiplied_by_the_parent_qty' => '総数量は 1枚あたりの数量 × 親数量 と等しくなければなりません。',

];
