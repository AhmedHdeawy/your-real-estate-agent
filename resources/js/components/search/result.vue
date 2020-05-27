<template>
  <section>
    <div class="search-results">
      <h2>نتائج البحث</h2>
      <div class="row">
        <div class="col-lg-3 col-md-4 col-6">
          <div class="search-result-box">
            <div class="img-con">
              <img alt="Group Image" class="img-fluid" src="/images/group.png" />
            </div>
            <h6>مجموعه نادى الشمس</h6>
            <p>عدد الأعضاء 22,520 عضو</p>
            <div class="btn-con">
              <button class="btn" data-target="#joinGroupModal" data-toggle="modal">
                <i class="fas fa-plus"></i>
                انضمام
              </button>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6">
          <div class="search-result-box">
            <div class="img-con">
              <img alt="Group Image" class="img-fluid" src="/images/group.png" />
            </div>
            <h6>مجموعه نادى الشمس</h6>
            <p>عدد الأعضاء 22,520 عضو</p>
            <div class="btn-con">
              <button class="btn" data-target="#joinGroupModal" data-toggle="modal">
                <i class="fas fa-plus"></i>
                انضمام
              </button>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6">
          <div class="search-result-box">
            <div class="img-con">
              <img alt="Group Image" class="img-fluid" src="/images/group.png" />
            </div>
            <h6>مجموعه نادى الشمس</h6>
            <p>عدد الأعضاء 22,520 عضو</p>
            <div class="btn-con">
              <button class="btn" data-target="#joinGroupModal" data-toggle="modal">
                <i class="fas fa-plus"></i>
                انضمام
              </button>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6">
          <div class="search-result-box">
            <div class="img-con">
              <img alt="Group Image" class="img-fluid" src="/images/group.png" />
            </div>
            <h6>مجموعه نادى الشمس</h6>
            <p>عدد الأعضاء 22,520 عضو</p>
            <div class="btn-con">
              <button class="btn" data-target="#joinGroupModal" data-toggle="modal">
                <i class="fas fa-plus"></i>
                انضمام
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Join Group Modal -->
    <div
      aria-hidden="true"
      aria-labelledby="exampleModalLabel"
      class="modal join-group-modal fade"
      id="joinGroupModal"
      role="dialog"
      tabindex="-1"
        >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <h4>برجاء الاجابة على سؤال الانضمام</h4>
          <p>
            هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في
            الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى
            نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء.
          </p>
          <div class="form-group">
            <textarea
              class="form-control"
              placeholder="أجابة سؤال الانضمام"
              title="Joining Question Answer"
            ></textarea>
          </div>
          <button class="btn">إرسال الاجابة</button>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
    props: {
    group: {
      type: Object,
      require: true
    }
  },
    data() {
    return {
      id: this.group.id,
      name: this.group.name,
      unique_name: this.group.unique_name,
      description: this.group.description,
      address: this.group.address,
      city: this.group.city,
      image: this.group.image,
      members_count: this.group.members_count,
      groups: [],
      page: 2
    };
  },
};
</script>
