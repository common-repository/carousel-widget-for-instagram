<?php
/**
 * Widget class for Instagram Carousel
 */

if (!defined("ABSPATH")) exit;

class Carousel_Widget_For_Instagram_Class extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            "carousel_widget_for_instagram_class",
            __("Carousel Widget For Instagram"),
            ["description" => "Displays Instagram feeds from different users"]
        );
    }

    /**
     *
     * Create back end widget form
     *
     * @param array $instance
     * @return void
     */
    public function form($instance)
    {

        /**
         * Set default widget settings
         */
        $defaults = [
            "amount" => 3,
            "usernames" => "",
            "cached" => 3,
            "title" => "Images",
            "hide_title" => null,
            "style" => "default",
            "hashtags" => ""
        ];
        $amount = !empty($instance["amount"]) ? $instance["amount"] : $defaults["amount"];
        $usernames = !empty($instance["usernames"]) ? $instance["usernames"] : $defaults["usernames"];
        $cached = !empty($instance["cached"]) ? $instance["cached"] : $defaults["cached"];
        $title = !empty($instance["title"]) ? $instance["title"] : $defaults["title"];
        $hide_title = !empty($instance["hide_title"]) ? $instance["hide_title"] : $defaults["hide_title"];
        $style = !empty($instance["style"]) ? $instance["style"] : $defaults["style"];
        $hashtags = !empty($instance["hashtags"]) ? $instance["hashtags"] : $defaults["hashtags"];


        /**
         * Output form
         */
        ?>

        <p>
            <span class="dashicons dashicons-editor-help widget-help-icon" data-toggle="popover" data-placement="top"
                  title="Style" data-content="Give a different look to your widget by selecting a color theme."></span>
            <label for="<?php echo $this->get_field_id("style"); ?>">Choose a style:</label>
            <select class="widefat" name="<?php echo $this->get_field_name("style"); ?>"
                    id="<?php echo $this->get_field_id("style"); ?>">
                <option value="default" <?php echo (esc_attr($style == 'default')) ? "selected" : null; ?>>Default
                </option>
                <option value="light" <?php echo (esc_attr($style == 'light')) ? "selected" : null; ?>>Light</option>
                <option value="dark" <?php echo (esc_attr($style == 'dark')) ? "selected" : null; ?>>Dark</option>
            </select>
        </p>
        <p>
            <span class="dashicons dashicons-editor-help widget-help-icon" data-toggle="popover" data-placement="top"
                  title="Title"
                  data-content="This title will appear above the list of instagrams. Check the 'hide' box to completely remove this title from the widget area."></span>
            <label for="<?php echo $this->get_field_id("title"); ?>">Widget Title:<span
                    style="float: right;"><em>hide</em> <input id="<?php echo $this->get_field_id("hide_title"); ?>"
                                                               type="checkbox"
                                                               name="<?php echo $this->get_field_name("hide_title"); ?>" <?php checked($hide_title, "on") ?>></span></label>
            <input type="text" class="widefat"
                   id="<?php echo $this->get_field_id("title"); ?>"
                   name="<?php echo $this->get_field_name("title"); ?>" value="<?php echo esc_attr($title); ?>"
                   style="<?php echo ($hide_title) ? "display: none;" : null; ?>">
        </p>
        <p>
            <span class="dashicons dashicons-editor-help widget-help-icon" data-toggle="popover" data-placement="top"
                  title="Tweets" data-content="This is the number or total instagrams that will be displayed."></span>
            <label for="<?php echo $this->get_field_id("amount"); ?>">Number of instagrams to show:</label>
            <input type="number" class="widefat" id="<?php echo $this->get_field_id("amount"); ?>"
                   name="<?php echo $this->get_field_name("amount"); ?>" value="<?php echo esc_attr($amount); ?>">
        </p>
        <p>
            <span class="dashicons dashicons-editor-help widget-help-icon" data-toggle="popover" data-placement="top"
                  title="Usernames"
                  data-content="Retrieve instagrams from different accounts by seperating usernames with a comma. '@' are not necessary."></span>
            <label for="<?php echo $this->get_field_id("usernames"); ?>">Usernames:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id("usernames"); ?>"
                   name="<?php echo $this->get_field_name("usernames"); ?>" value="<?php echo esc_attr($usernames); ?>">
        </p>
        <p>
            <span class="dashicons dashicons-editor-help widget-help-icon" data-toggle="popover" data-placement="top"
                  title="Hashtags" data-content="Seperate hashtags with a comma."></span>
            <label for="<?php echo $this->get_field_id("hashtags"); ?>">Hastags:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id("hashtags"); ?>"
                   name="<?php echo $this->get_field_name("hashtags"); ?>" value="<?php echo esc_attr($hashtags); ?>">
        </p>
        <p>
            <span class="dashicons dashicons-editor-help widget-help-icon" data-toggle="popover" data-placement="top"
                  title="Update Frequency"
                  data-content="If a page refreshes before the amount of minutes defined here, new instagrams will be fetched from the server; otherwise cached instagrams will be displayed, which is much faster. Avoid fetching too often to speed up your pages loading time."></span>
            <label for="<?php echo $this->get_field_id("cached"); ?>">Update frequency (minutes)</label>
            <input type="number" min="1" max="999" class="widefat" id="<?php echo $this->get_field_id("cached"); ?>"
                   name="<?php echo $this->get_field_name("cached"); ?>" value="<?php echo esc_attr($cached); ?>">
        </p>


        <?php
        /**
         * Show/Hide fields depending on checkbox state
         */
        ?>
        <script type="text/javascript">
            (function ($) {

                $('[data-toggle="popover"]').popover()

                $(document).on("change", "input[id*='hide_title']", function () {

                    var title = $(this).parent().parent().parent().find("input[id*='-title']")

                    if ($(this).is(":checked")) {
                        title.fadeOut();
                    } else {
                        title.fadeIn();
                    }

                })

                $(document).on("change", "input[id*='dynamic_height']", function () {
                    var height_input = $(this).parent().parent().parent().find("input[id*='-height']")

                    if ($(this).is(":checked")) {
                        height_input.fadeOut();
                    } else {
                        height_input.fadeIn();
                    }
                })

            })(jQuery)
        </script>

        <style type="text/css">
            .widget-help-icon {
                opacity: 0.5;
                cursor: pointer;
            }

            .widget-help-icon:hover {
                opacity: 1;
            }
        </style>

        <?php
    }


    /**
     *
     * Save widget form
     *
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance["title"] = strip_tags($new_instance["title"]);
        $instance["style"] = strip_tags($new_instance["style"]);
        $instance["hide_title"] = strip_tags($new_instance["hide_title"]);
        $instance["amount"] = strip_tags($new_instance["amount"]);
        $instance["usernames"] = trim(str_replace(" ", "", str_replace("@", "", strip_tags($new_instance["usernames"]))));
        $instance["hashtags"] = trim(str_replace(" ", "", str_replace("#", "", strip_tags($new_instance["hashtags"]))));
        $instance["cached"] = strip_tags($new_instance["cached"]);
        delete_option($this->id);
        return $instance;
    }

    /**
     *
     * Display front end widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {

        $option_name = $args["widget_id"];
        $last_update = get_option($option_name);
        $cache_timer = 60000 * $instance["cached"];

        if (time() - $last_update["timestamp"] < $cache_timer) {
            $output = $last_update["instagrams"];
        } else {
            $unsorted_instagrams = [];

            if (strlen($instance["usernames"]) > 0) {
                $users = explode(",", $instance["usernames"]);
                $url = "https://www.instagram.com/USERNAME/media";
                foreach ($users as $user) {
                    $username = trim($user);
                    $this_url = str_replace("USERNAME", $username, $url);
                    $items = [];

                    $raw_data = file_get_contents($this_url);
                    $json = json_decode($raw_data, true);
                    if ($json["status"] == "ok") {
                        $items = $json["items"];
                    }

                    foreach ($items as $item) {
                        $this_item = [
                            "created_at" => $item["caption"]["created_time"],
                            "username" => $item["caption"]["from"]["username"],
                            "caption" => $item["caption"]["text"],
                            "thumbnail" => $item["images"]["thumbnail"]["url"],
                            "image" => $item["images"]["standard_resolution"]["url"]
                        ];
                        $unsorted_instagrams[] = $this_item;

                    }
                }
            }

            if (strlen($instance["hashtags"]) > 0) {
                $hashtags = explode(",", $instance["hashtags"]);
                foreach ($hashtags as $i => $hashtag) {

                    $instagrams = cwfig_scrape_insta_hash($hashtag);
                    foreach ($instagrams["entry_data"]["TagPage"][0]["tag"]["media"]["nodes"] as $item) {
                        $this_item = [
                            "created_at" => $item["date"],
                            "username" => $item["owner"]["id"],
                            "caption" => $item["caption"],
                            "thumbnail" => $item["thumbnail_src"],
                            "image" => $item["display_src"]
                        ];
                        $unsorted_instagrams[] = $this_item;

                    }
                }
            }


            foreach ($unsorted_instagrams as $key => $part) {
                $sort[$key] = $part['created_at'];
            }
            array_multisort($sort, SORT_DESC, $unsorted_instagrams);
            $output = array_slice($unsorted_instagrams, 0, $instance["amount"]);

            $widget_options = [
                "timestamp" => time(),
                "instagrams" => $output
            ];
            update_option($option_name, $widget_options);

        }
        $carousel_id = "carousel_" . $args["widget_id"];
        echo "<section class='widget instagram-carousel-widget cwfig-" . $instance["style"] . "' id='" . $args["widget_id"] . "'>";
        if (!$instance["hide_title"]) {
            echo "<h2 class='cwfig-widget-title'>" . $instance["title"] . "</h2>";
        }

        ?>

        <div id="<?php echo $carousel_id ?>" class="carousel slide cwfig-carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($output as $index => $instagram): ?>
                    <div class="item <?php echo ($index == 0) ? "active" : null; ?>">
                        <img class='img-responsive cwfig-img' alt='<?php echo $instagram["caption"] ?>'
                             src='<?php echo $instagram["image"] ?>'/>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php
        echo "</section>";

    }
}

/**
 *
 * Pretty/verbose time format
 * ex: 5 minutes ago
 *
 * @param $time
 * @return string
 */
function cwfig_relativeTime($time)
{
    $delta = time() - $time;

    if ($delta < 1 * 60) {
        return $delta == 1 ? "one second ago" : $delta . " seconds ago";
    }
    if ($delta < 2 * 60) {
        return "a minute ago";
    }
    if ($delta < 45 * 60) {
        return floor($delta / 60) . " minutes ago";
    }
    if ($delta < 90 * 60) {
        return "an hour ago";
    }
    if ($delta < 24 * 3600) {
        return floor($delta / 3600) . " hours ago";
    }
    if ($delta < 48 * 3600) {
        return "yesterday";
    }
    if ($delta < 30 * 86400) {
        return floor($delta / 86400) . " days ago";
    }
    if ($delta < 12 * 2592000) {
        $months = floor($delta / 86400 / 30);
        return $months <= 1 ? "one month ago" : $months . " months ago";
    } else {
        $years = floor($delta / 86400 / 365);
        return $years <= 1 ? "one year ago" : $years . " years ago";
    }
}

/**
 *
 * Parse json data on Instagram page
 *
 * @param string $tag
 * @return array
 */
function cwfig_scrape_insta_hash($tag)
{
    $insta_source = file_get_contents('https://www.instagram.com/explore/tags/' . $tag . '/');
    $shards = explode('window._sharedData = ', $insta_source);
    $insta_json = explode(';</script>', $shards[1]);
    $insta_array = json_decode($insta_json[0], TRUE);
    return $insta_array;
}

/**
 * Register widget to Wordpress
 */
function cwfig_register_widget()
{
    register_widget("Carousel_Widget_For_Instagram_Class");
}

add_action("widgets_init", "cwfig_register_widget");