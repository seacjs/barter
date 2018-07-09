<?php
/**
 * Created by PhpStorm.
 * User: sea-c
 * Date: 22.06.2018
 * Time: 13:39
 */

?>

<div class="people">

        <?= \app\widgets\UserSearchWidget::widget()?>

    <div class="people__title">Участники</div>
    <div class="people__content">
        <div class="people__main">

            <?php foreach($users as $user):?>

                <div class="people__block">
                    <img class="people__profile" src='/images/people1.png'>
                    <div class="people__rating">5</div>
                    </img>
                    <div class="people__info">
                        <span class="people__name"><?=$user->username?></span>
                        <span class="people__city"><?=$user->profile->city->name?></span>
                    </div>
                    <?php if($user->isMe || $user->isOnline): ?>
                        <div class="people__status people__status--online"></div>
                    <?php else: ?>
                        <div class="people__status"></div>
                    <?php endif ?>
                    <a href="/messages/view/<?=$user->id?>"><button class="people__button" >Написать</button></a>
                </div>

            <?php endforeach ?>

        </div>
        <div class="people__sidebar">
            <div class="people__city-chose">
                <select class="people__city-list">
                    <option selected>Выбор города</option>
                    <option>Москва</option>
                    <option>Санкт-Петербург</option>
                    <option>Волгоград</option>
                    <option>Владивосток</option>
                    <option>Воронеж</option>
                    <option>Екатеринбург</option>
                    <option>Казань</option>
                    <option>Волгоград</option>
                    <option>Владивосток</option>
                    <option>Воронеж</option>
                    <option>Екатеринбург</option>
                    <option>Казань</option>
                    <option>Волгоград</option>
                    <option>Владивосток</option>
                    <option>Воронеж</option>
                    <option>Екатеринбург</option>
                    <option>Казань</option>
                </select>
            </div>
            <div class="people__age-chose">
                Возраст
                <select class="people__age">
                    <option selected>от</option>
                    <option value="">18</option>
                    <option value="">19</option>
                    <option value="">20</option>
                    <option value="">21</option>
                    <option value="">22</option>
                    <option value="">23</option>
                    <option value="">24</option>
                    <option value="">25</option>
                    <option value="">26</option>
                    <option value="">27</option>
                    <option value="">28</option>
                    <option value="">29</option>
                    <option value="">30</option>
                    <option value="">31</option>
                    <option value="">32</option>
                    <option value="">33</option>
                    <option value="">34</option>
                    <option value="">35</option>
                    <option value="">36</option>
                    <option value="">37</option>
                    <option value="">38</option>
                    <option value="">39</option>
                    <option value="">40</option>
                    <option value="">41</option>
                    <option value="">42</option>
                    <option value="">43</option>
                    <option value="">44</option>
                    <option value="">45</option>
                    <option value="">46</option>
                    <option value="">47</option>
                    <option value="">48</option>
                    <option value="">49</option>
                    <option value="">50</option>
                    <option value="">51</option>
                    <option value="">52</option>
                    <option value="">53</option>
                    <option value="">54</option>
                    <option value="">55</option>
                    <option value="">56</option>
                    <option value="">57</option>
                    <option value="">58</option>
                    <option value="">59</option>
                    <option value="">60</option>
                    <option value="">61</option>
                    <option value="">62</option>
                    <option value="">63</option>
                    <option value="">64</option>
                    <option value="">65</option>
                    <option value="">66</option>
                    <option value="">67</option>
                    <option value="">68</option>
                    <option value="">69</option>
                    <option value="">70</option>
                    <option value="">71</option>
                    <option value="">72</option>
                    <option value="">73</option>
                    <option value="">74</option>
                    <option value="">75</option>
                    <option value="">76</option>
                    <option value="">77</option>
                    <option value="">78</option>
                    <option value="">79</option>
                    <option value="">80</option>
                    <option value="">81</option>
                    <option value="">82</option>
                    <option value="">83</option>
                    <option value="">84</option>
                    <option value="">85</option>
                    <option value="">86</option>
                    <option value="">87</option>
                    <option value="">88</option>
                    <option value="">89</option>
                    <option value="">90</option>
                    <option value="">91</option>
                    <option value="">92</option>
                    <option value="">93</option>
                    <option value="">94</option>
                    <option value="">95</option>
                    <option value="">96</option>
                    <option value="">97</option>
                    <option value="">98</option>
                    <option value="">99</option>
                    <option value="">100</option>
                </select>
                -
                <select class="people__age">
                    <option selected>до</option>
                    <option value="">18</option>
                    <option value="">19</option>
                    <option value="">20</option>
                    <option value="">21</option>
                    <option value="">22</option>
                    <option value="">23</option>
                    <option value="">24</option>
                    <option value="">25</option>
                    <option value="">26</option>
                    <option value="">27</option>
                    <option value="">28</option>
                    <option value="">29</option>
                    <option value="">30</option>
                    <option value="">31</option>
                    <option value="">32</option>
                    <option value="">33</option>
                    <option value="">34</option>
                    <option value="">35</option>
                    <option value="">36</option>
                    <option value="">37</option>
                    <option value="">38</option>
                    <option value="">39</option>
                    <option value="">40</option>
                    <option value="">41</option>
                    <option value="">42</option>
                    <option value="">43</option>
                    <option value="">44</option>
                    <option value="">45</option>
                    <option value="">46</option>
                    <option value="">47</option>
                    <option value="">48</option>
                    <option value="">49</option>
                    <option value="">50</option>
                    <option value="">51</option>
                    <option value="">52</option>
                    <option value="">53</option>
                    <option value="">54</option>
                    <option value="">55</option>
                    <option value="">56</option>
                    <option value="">57</option>
                    <option value="">58</option>
                    <option value="">59</option>
                    <option value="">60</option>
                    <option value="">61</option>
                    <option value="">62</option>
                    <option value="">63</option>
                    <option value="">64</option>
                    <option value="">65</option>
                    <option value="">66</option>
                    <option value="">67</option>
                    <option value="">68</option>
                    <option value="">69</option>
                    <option value="">70</option>
                    <option value="">71</option>
                    <option value="">72</option>
                    <option value="">73</option>
                    <option value="">74</option>
                    <option value="">75</option>
                    <option value="">76</option>
                    <option value="">77</option>
                    <option value="">78</option>
                    <option value="">79</option>
                    <option value="">80</option>
                    <option value="">81</option>
                    <option value="">82</option>
                    <option value="">83</option>
                    <option value="">84</option>
                    <option value="">85</option>
                    <option value="">86</option>
                    <option value="">87</option>
                    <option value="">88</option>
                    <option value="">89</option>
                    <option value="">90</option>
                    <option value="">91</option>
                    <option value="">92</option>
                    <option value="">93</option>
                    <option value="">94</option>
                    <option value="">95</option>
                    <option value="">96</option>
                    <option value="">97</option>
                    <option value="">98</option>
                    <option value="">99</option>
                    <option value="">100</option>
                </select>
            </div>
        </div>
    </div>
</div>