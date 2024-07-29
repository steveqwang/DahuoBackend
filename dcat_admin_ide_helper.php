<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection activity_type_id
     * @property Grid\Column|Collection image
     * @property Grid\Column|Collection images
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection activity_date
     * @property Grid\Column|Collection start_time
     * @property Grid\Column|Collection end_time
     * @property Grid\Column|Collection sign_up_end_time
     * @property Grid\Column|Collection activity_number
     * @property Grid\Column|Collection sign_up_number
     * @property Grid\Column|Collection address
     * @property Grid\Column|Collection content
     * @property Grid\Column|Collection longitude
     * @property Grid\Column|Collection latitude
     * @property Grid\Column|Collection read_number
     * @property Grid\Column|Collection price
     * @property Grid\Column|Collection is_open
     * @property Grid\Column|Collection is_prohibit
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection nan_num
     * @property Grid\Column|Collection nv_num
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection underlined_price
     * @property Grid\Column|Collection province_id
     * @property Grid\Column|Collection city_id
     * @property Grid\Column|Collection district_id
     * @property Grid\Column|Collection province
     * @property Grid\Column|Collection city
     * @property Grid\Column|Collection district
     * @property Grid\Column|Collection activity_id
     * @property Grid\Column|Collection star
     * @property Grid\Column|Collection reply_content
     * @property Grid\Column|Collection reason
     * @property Grid\Column|Collection q_user_id
     * @property Grid\Column|Collection q_content
     * @property Grid\Column|Collection a_user_id
     * @property Grid\Column|Collection a_content
     * @property Grid\Column|Collection order_no
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection phone
     * @property Grid\Column|Collection emergency_contact
     * @property Grid\Column|Collection emergency_contact_phone
     * @property Grid\Column|Collection pay_status
     * @property Grid\Column|Collection pay_time
     * @property Grid\Column|Collection pay_price
     * @property Grid\Column|Collection cancel_reason
     * @property Grid\Column|Collection cancel_explain
     * @property Grid\Column|Collection sex
     * @property Grid\Column|Collection sort
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection img
     * @property Grid\Column|Collection deleted_at
     * @property Grid\Column|Collection code
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection tokenable_type
     * @property Grid\Column|Collection tokenable_id
     * @property Grid\Column|Collection abilities
     * @property Grid\Column|Collection last_used_at
     * @property Grid\Column|Collection alias
     * @property Grid\Column|Collection bias_id
     * @property Grid\Column|Collection follow_id
     * @property Grid\Column|Collection interest_id
     * @property Grid\Column|Collection remark
     * @property Grid\Column|Collection search_date
     * @property Grid\Column|Collection search_num
     * @property Grid\Column|Collection ti_time
     * @property Grid\Column|Collection type_id
     * @property Grid\Column|Collection nickname
     * @property Grid\Column|Collection birthday
     * @property Grid\Column|Collection school
     * @property Grid\Column|Collection occupation
     * @property Grid\Column|Collection real_name
     * @property Grid\Column|Collection id_card
     * @property Grid\Column|Collection is_real_name
     * @property Grid\Column|Collection fans_count
     * @property Grid\Column|Collection follow_count
     * @property Grid\Column|Collection openid
     * @property Grid\Column|Collection session_key
     * @property Grid\Column|Collection api_token
     * @property Grid\Column|Collection my_invite_code
     * @property Grid\Column|Collection invite_code
     * @property Grid\Column|Collection invite_user_id
     * @property Grid\Column|Collection invite_count
     * @property Grid\Column|Collection is_vip
     * @property Grid\Column|Collection vip_end_time
     * @property Grid\Column|Collection activity_num
     * @property Grid\Column|Collection last_day
     * @property Grid\Column|Collection days
     * @property Grid\Column|Collection privilege
     * @property Grid\Column|Collection vip_id
     * @property Grid\Column|Collection vip_title
     *
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection activity_type_id(string $label = null)
     * @method Grid\Column|Collection image(string $label = null)
     * @method Grid\Column|Collection images(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection activity_date(string $label = null)
     * @method Grid\Column|Collection start_time(string $label = null)
     * @method Grid\Column|Collection end_time(string $label = null)
     * @method Grid\Column|Collection sign_up_end_time(string $label = null)
     * @method Grid\Column|Collection activity_number(string $label = null)
     * @method Grid\Column|Collection sign_up_number(string $label = null)
     * @method Grid\Column|Collection address(string $label = null)
     * @method Grid\Column|Collection content(string $label = null)
     * @method Grid\Column|Collection longitude(string $label = null)
     * @method Grid\Column|Collection latitude(string $label = null)
     * @method Grid\Column|Collection read_number(string $label = null)
     * @method Grid\Column|Collection price(string $label = null)
     * @method Grid\Column|Collection is_open(string $label = null)
     * @method Grid\Column|Collection is_prohibit(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection nan_num(string $label = null)
     * @method Grid\Column|Collection nv_num(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection underlined_price(string $label = null)
     * @method Grid\Column|Collection province_id(string $label = null)
     * @method Grid\Column|Collection city_id(string $label = null)
     * @method Grid\Column|Collection district_id(string $label = null)
     * @method Grid\Column|Collection province(string $label = null)
     * @method Grid\Column|Collection city(string $label = null)
     * @method Grid\Column|Collection district(string $label = null)
     * @method Grid\Column|Collection activity_id(string $label = null)
     * @method Grid\Column|Collection star(string $label = null)
     * @method Grid\Column|Collection reply_content(string $label = null)
     * @method Grid\Column|Collection reason(string $label = null)
     * @method Grid\Column|Collection q_user_id(string $label = null)
     * @method Grid\Column|Collection q_content(string $label = null)
     * @method Grid\Column|Collection a_user_id(string $label = null)
     * @method Grid\Column|Collection a_content(string $label = null)
     * @method Grid\Column|Collection order_no(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection phone(string $label = null)
     * @method Grid\Column|Collection emergency_contact(string $label = null)
     * @method Grid\Column|Collection emergency_contact_phone(string $label = null)
     * @method Grid\Column|Collection pay_status(string $label = null)
     * @method Grid\Column|Collection pay_time(string $label = null)
     * @method Grid\Column|Collection pay_price(string $label = null)
     * @method Grid\Column|Collection cancel_reason(string $label = null)
     * @method Grid\Column|Collection cancel_explain(string $label = null)
     * @method Grid\Column|Collection sex(string $label = null)
     * @method Grid\Column|Collection sort(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection img(string $label = null)
     * @method Grid\Column|Collection deleted_at(string $label = null)
     * @method Grid\Column|Collection code(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection tokenable_type(string $label = null)
     * @method Grid\Column|Collection tokenable_id(string $label = null)
     * @method Grid\Column|Collection abilities(string $label = null)
     * @method Grid\Column|Collection last_used_at(string $label = null)
     * @method Grid\Column|Collection alias(string $label = null)
     * @method Grid\Column|Collection bias_id(string $label = null)
     * @method Grid\Column|Collection follow_id(string $label = null)
     * @method Grid\Column|Collection interest_id(string $label = null)
     * @method Grid\Column|Collection remark(string $label = null)
     * @method Grid\Column|Collection search_date(string $label = null)
     * @method Grid\Column|Collection search_num(string $label = null)
     * @method Grid\Column|Collection ti_time(string $label = null)
     * @method Grid\Column|Collection type_id(string $label = null)
     * @method Grid\Column|Collection nickname(string $label = null)
     * @method Grid\Column|Collection birthday(string $label = null)
     * @method Grid\Column|Collection school(string $label = null)
     * @method Grid\Column|Collection occupation(string $label = null)
     * @method Grid\Column|Collection real_name(string $label = null)
     * @method Grid\Column|Collection id_card(string $label = null)
     * @method Grid\Column|Collection is_real_name(string $label = null)
     * @method Grid\Column|Collection fans_count(string $label = null)
     * @method Grid\Column|Collection follow_count(string $label = null)
     * @method Grid\Column|Collection openid(string $label = null)
     * @method Grid\Column|Collection session_key(string $label = null)
     * @method Grid\Column|Collection api_token(string $label = null)
     * @method Grid\Column|Collection my_invite_code(string $label = null)
     * @method Grid\Column|Collection invite_code(string $label = null)
     * @method Grid\Column|Collection invite_user_id(string $label = null)
     * @method Grid\Column|Collection invite_count(string $label = null)
     * @method Grid\Column|Collection is_vip(string $label = null)
     * @method Grid\Column|Collection vip_end_time(string $label = null)
     * @method Grid\Column|Collection activity_num(string $label = null)
     * @method Grid\Column|Collection last_day(string $label = null)
     * @method Grid\Column|Collection days(string $label = null)
     * @method Grid\Column|Collection privilege(string $label = null)
     * @method Grid\Column|Collection vip_id(string $label = null)
     * @method Grid\Column|Collection vip_title(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection id
     * @property Show\Field|Collection activity_type_id
     * @property Show\Field|Collection image
     * @property Show\Field|Collection images
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection status
     * @property Show\Field|Collection activity_date
     * @property Show\Field|Collection start_time
     * @property Show\Field|Collection end_time
     * @property Show\Field|Collection sign_up_end_time
     * @property Show\Field|Collection activity_number
     * @property Show\Field|Collection sign_up_number
     * @property Show\Field|Collection address
     * @property Show\Field|Collection content
     * @property Show\Field|Collection longitude
     * @property Show\Field|Collection latitude
     * @property Show\Field|Collection read_number
     * @property Show\Field|Collection price
     * @property Show\Field|Collection is_open
     * @property Show\Field|Collection is_prohibit
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection nan_num
     * @property Show\Field|Collection nv_num
     * @property Show\Field|Collection type
     * @property Show\Field|Collection underlined_price
     * @property Show\Field|Collection province_id
     * @property Show\Field|Collection city_id
     * @property Show\Field|Collection district_id
     * @property Show\Field|Collection province
     * @property Show\Field|Collection city
     * @property Show\Field|Collection district
     * @property Show\Field|Collection activity_id
     * @property Show\Field|Collection star
     * @property Show\Field|Collection reply_content
     * @property Show\Field|Collection reason
     * @property Show\Field|Collection q_user_id
     * @property Show\Field|Collection q_content
     * @property Show\Field|Collection a_user_id
     * @property Show\Field|Collection a_content
     * @property Show\Field|Collection order_no
     * @property Show\Field|Collection name
     * @property Show\Field|Collection phone
     * @property Show\Field|Collection emergency_contact
     * @property Show\Field|Collection emergency_contact_phone
     * @property Show\Field|Collection pay_status
     * @property Show\Field|Collection pay_time
     * @property Show\Field|Collection pay_price
     * @property Show\Field|Collection cancel_reason
     * @property Show\Field|Collection cancel_explain
     * @property Show\Field|Collection sex
     * @property Show\Field|Collection sort
     * @property Show\Field|Collection version
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection order
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection username
     * @property Show\Field|Collection password
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection img
     * @property Show\Field|Collection deleted_at
     * @property Show\Field|Collection code
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection email
     * @property Show\Field|Collection token
     * @property Show\Field|Collection tokenable_type
     * @property Show\Field|Collection tokenable_id
     * @property Show\Field|Collection abilities
     * @property Show\Field|Collection last_used_at
     * @property Show\Field|Collection alias
     * @property Show\Field|Collection bias_id
     * @property Show\Field|Collection follow_id
     * @property Show\Field|Collection interest_id
     * @property Show\Field|Collection remark
     * @property Show\Field|Collection search_date
     * @property Show\Field|Collection search_num
     * @property Show\Field|Collection ti_time
     * @property Show\Field|Collection type_id
     * @property Show\Field|Collection nickname
     * @property Show\Field|Collection birthday
     * @property Show\Field|Collection school
     * @property Show\Field|Collection occupation
     * @property Show\Field|Collection real_name
     * @property Show\Field|Collection id_card
     * @property Show\Field|Collection is_real_name
     * @property Show\Field|Collection fans_count
     * @property Show\Field|Collection follow_count
     * @property Show\Field|Collection openid
     * @property Show\Field|Collection session_key
     * @property Show\Field|Collection api_token
     * @property Show\Field|Collection my_invite_code
     * @property Show\Field|Collection invite_code
     * @property Show\Field|Collection invite_user_id
     * @property Show\Field|Collection invite_count
     * @property Show\Field|Collection is_vip
     * @property Show\Field|Collection vip_end_time
     * @property Show\Field|Collection activity_num
     * @property Show\Field|Collection last_day
     * @property Show\Field|Collection days
     * @property Show\Field|Collection privilege
     * @property Show\Field|Collection vip_id
     * @property Show\Field|Collection vip_title
     *
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection activity_type_id(string $label = null)
     * @method Show\Field|Collection image(string $label = null)
     * @method Show\Field|Collection images(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection activity_date(string $label = null)
     * @method Show\Field|Collection start_time(string $label = null)
     * @method Show\Field|Collection end_time(string $label = null)
     * @method Show\Field|Collection sign_up_end_time(string $label = null)
     * @method Show\Field|Collection activity_number(string $label = null)
     * @method Show\Field|Collection sign_up_number(string $label = null)
     * @method Show\Field|Collection address(string $label = null)
     * @method Show\Field|Collection content(string $label = null)
     * @method Show\Field|Collection longitude(string $label = null)
     * @method Show\Field|Collection latitude(string $label = null)
     * @method Show\Field|Collection read_number(string $label = null)
     * @method Show\Field|Collection price(string $label = null)
     * @method Show\Field|Collection is_open(string $label = null)
     * @method Show\Field|Collection is_prohibit(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection nan_num(string $label = null)
     * @method Show\Field|Collection nv_num(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection underlined_price(string $label = null)
     * @method Show\Field|Collection province_id(string $label = null)
     * @method Show\Field|Collection city_id(string $label = null)
     * @method Show\Field|Collection district_id(string $label = null)
     * @method Show\Field|Collection province(string $label = null)
     * @method Show\Field|Collection city(string $label = null)
     * @method Show\Field|Collection district(string $label = null)
     * @method Show\Field|Collection activity_id(string $label = null)
     * @method Show\Field|Collection star(string $label = null)
     * @method Show\Field|Collection reply_content(string $label = null)
     * @method Show\Field|Collection reason(string $label = null)
     * @method Show\Field|Collection q_user_id(string $label = null)
     * @method Show\Field|Collection q_content(string $label = null)
     * @method Show\Field|Collection a_user_id(string $label = null)
     * @method Show\Field|Collection a_content(string $label = null)
     * @method Show\Field|Collection order_no(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection phone(string $label = null)
     * @method Show\Field|Collection emergency_contact(string $label = null)
     * @method Show\Field|Collection emergency_contact_phone(string $label = null)
     * @method Show\Field|Collection pay_status(string $label = null)
     * @method Show\Field|Collection pay_time(string $label = null)
     * @method Show\Field|Collection pay_price(string $label = null)
     * @method Show\Field|Collection cancel_reason(string $label = null)
     * @method Show\Field|Collection cancel_explain(string $label = null)
     * @method Show\Field|Collection sex(string $label = null)
     * @method Show\Field|Collection sort(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection img(string $label = null)
     * @method Show\Field|Collection deleted_at(string $label = null)
     * @method Show\Field|Collection code(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection tokenable_type(string $label = null)
     * @method Show\Field|Collection tokenable_id(string $label = null)
     * @method Show\Field|Collection abilities(string $label = null)
     * @method Show\Field|Collection last_used_at(string $label = null)
     * @method Show\Field|Collection alias(string $label = null)
     * @method Show\Field|Collection bias_id(string $label = null)
     * @method Show\Field|Collection follow_id(string $label = null)
     * @method Show\Field|Collection interest_id(string $label = null)
     * @method Show\Field|Collection remark(string $label = null)
     * @method Show\Field|Collection search_date(string $label = null)
     * @method Show\Field|Collection search_num(string $label = null)
     * @method Show\Field|Collection ti_time(string $label = null)
     * @method Show\Field|Collection type_id(string $label = null)
     * @method Show\Field|Collection nickname(string $label = null)
     * @method Show\Field|Collection birthday(string $label = null)
     * @method Show\Field|Collection school(string $label = null)
     * @method Show\Field|Collection occupation(string $label = null)
     * @method Show\Field|Collection real_name(string $label = null)
     * @method Show\Field|Collection id_card(string $label = null)
     * @method Show\Field|Collection is_real_name(string $label = null)
     * @method Show\Field|Collection fans_count(string $label = null)
     * @method Show\Field|Collection follow_count(string $label = null)
     * @method Show\Field|Collection openid(string $label = null)
     * @method Show\Field|Collection session_key(string $label = null)
     * @method Show\Field|Collection api_token(string $label = null)
     * @method Show\Field|Collection my_invite_code(string $label = null)
     * @method Show\Field|Collection invite_code(string $label = null)
     * @method Show\Field|Collection invite_user_id(string $label = null)
     * @method Show\Field|Collection invite_count(string $label = null)
     * @method Show\Field|Collection is_vip(string $label = null)
     * @method Show\Field|Collection vip_end_time(string $label = null)
     * @method Show\Field|Collection activity_num(string $label = null)
     * @method Show\Field|Collection last_day(string $label = null)
     * @method Show\Field|Collection days(string $label = null)
     * @method Show\Field|Collection privilege(string $label = null)
     * @method Show\Field|Collection vip_id(string $label = null)
     * @method Show\Field|Collection vip_title(string $label = null)
     */
    class Show {}

    /**
     * @method \SuperEggs\DcatDistpicker\Form\Distpicker distpicker(...$params)
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     * @method $this distpicker(...$params)
     */
    class Column {}

    /**
     * @method \SuperEggs\DcatDistpicker\Filter\DistpickerFilter distpicker(...$params)
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
