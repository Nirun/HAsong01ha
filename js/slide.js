var firstbgcarousel=new bgCarousel({
    wrapperid: 'mybgcarousel', //ID of blank DIV on page to house carousel
    imagearray: [
        ['front/img1.jpg', '<font class="fronttext">สถาบันรับรองคุณภาพสถานพยาบาล (องค์การมหาชน) ร่วมกับศูนย์ความร่วมมือเพื่อการพัฒนาคุณภาพโรงพยาบาล คณะแพทยศาสตร์ มหาวิทยาลัยขอนแก่น จัดงานประชุมวิชาการ Northeast Regional HA Forum ครั้งที่ 9</font><br /><font class="subfronttext">เรียนรู้บรูณาการ งานกับชีวิต  </font>'],
        ['front/img2.jpg',  '<font class="fronttext">ระหว่างวันที่ 25-27 กรกฎาคม 2555ที่ผ่านมา ณ โรงแรมพูลแมน จังหวัดขอนแก่น </font><br /><font class="subfronttext">โดยการประชุมในครั้งนี้มีบุคลากรทางการแพทย์และสาธารณสุขเข้าร่วมการประชุมกว่า 700 ท่าน  </font>'],
        ['front/img3.jpg',  '<font class="fronttext">นายแพทย์อนุวัฒน์ ศุภชุติกุลผู้อำนวยการสถาบันรับรองสถานพยาบาล(องค์การมหาชน) ร่วมเป็นวิทยากรบรรยาย หัวข้อเรื่อง HA Hint & Update </font><br /><font class="subfronttext">ในงานประชุมวิชาการ Northeast Regional HA Forum ครั้งที่ 9 : เรียนรู้บรูณาการ งานกับชีวิต </font>'],
        ['front/img4.jpg',  '<font class="fronttext">กิจกรรม WORK SHOP </font><br /><font class="subfronttext">คลินิกให้คำปรึกษา ปัญหา HA ให้กับผู้แทนโรงพยาบาลต่างๆ ที่เข้าร่วมการประชุมได้เข้ามาปรึกษาหารือเพื่อหาแนวทางในการแก้ไขปัญหาในการพัฒนาคุณภาพโรงพยาบาล </font>'] //<--no trailing comma after very last image element!
    ],
    displaymode: {type:'auto', pause:3000, cycles:20, stoponclick:false, pauseonmouseover:true},
    navbuttons: ['left.png', 'right.png', 'up.gif', 'down.gif'], // path to nav images
    activeslideclass: 'selectedslide', // CSS class that gets added to currently shown DIV slide
    orientation: 'h', //Valid values: "h" or "v"
    persist: true, //remember last viewed slide and recall within same session?
    slideduration: 900 //transition duration (milliseconds)
})