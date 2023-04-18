<div class="body">
  <div class="inner_wrap">
    <div class="page_top_title">
      <h1>주문/결제</h1>
      <p class="path">HOME<span>&gt;</span>주문/결제<span></p>
    </div>

    <div class="cart_list">

      <table class="order_table">
        <tr>
          <th width="600">상품정보</th>
          <th>수량</th>
          <th>상품금액</th>
          <th>할인금액</th>
          <th>배송비</th>
          <th>주문금액</th>
        </tr>
        <tr>
          <td colspan="6" class="title">[로캣주식회사]로캣티어 1호 인기상품</td>
        </tr>
        <tr>
          <td class="product_info">
						<div class="img_wrap">
							<img src="/images/product_default.png" alt="">
						</div>
            <strong>색상: 블랙(280) / 사이즈: 230</strong>
          </td>
          <td>1</td>
          <td class="cost">105,000 원</td>
          <td class="cost">1,000 원</td>
          <td class="cost">2,500 원</td>
          <td class="cost">95,000 원</td>
        </tr>
        <tr>
          <td class="product_info">
						<div class="img_wrap">
							<img src="/images/product_default.png" alt="">
						</div>
            <strong>색상: 레드(280) / 사이즈: 230</strong>
          </td>
          <td>1</td>
          <td class="cost">105,000 원</td>
          <td class="cost">1,000 원</td>
          <td class="cost">0 원</td>
          <td class="cost">95,000 원</td>
        </tr>
        <tr>
          <td class="product_info">
						<div class="img_wrap">
							<img src="/images/product_default.png" alt="">
						</div>
            <strong>색상: 핑크(280) / 사이즈: 230</strong>
          </td>
          <td>1</td>
          <td class="cost">105,000 원</td>
          <td class="cost">1,000 원</td>
          <td class="cost">0 원</td>
          <td class="cost">95,000 원</td>
        </tr>
        <tr>
          <td colspan="6" class="title">[달팽이리빙]보온보냉 티포트</td>
        </tr>
        <tr>
          <td class="product_info">
						<div class="img_wrap">
							<img src="/images/product_default.png" alt="">
						</div>
            <strong>색상: 핑크(280) / 사이즈: 230</strong>
          </td>
          <td>1</td>
          <td class="cost">105,000 원</td>
          <td class="cost">1,000 원</td>
          <td class="cost">2,500 원</td>
          <td class="cost">95,000 원</td>
        </tr>
      </table>

      <!-- order_info_wrap : s -->
      <div class="order_info_wrap">

        <!-- delivery_info : s -->
        <div class="delivery_info">
          <h2>배송지 정보</h2>
          <table>
            <tr>
              <th>배송지선택</th>
              <td>
                <input type="radio" id="basic_address" name="address_chk" checked><label for="basic_address"><span></span>기본배송지</label>
                <input type="radio" id="new_address" name="address_chk"><label for="new_address"><span></span>신규배송지</label>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <div class="address_view">
                  홍길동<br>
                  010-2456-9875<br>
                  서울시 금천구 가산디지털 1로 145 에이스하이엔드타워 3차 314호
                </div>
              </td>
            </tr>
            <tr>
              <th>수령인</th>
              <td><input class="s_input" type="text" name=""></td>
            </tr>
            <tr>
              <th>연락처</th>
              <td><input class="m_input" type="text" name=""></td>
            </tr>
            <tr>
              <th>배송지 주소</th>
              <td>
                <div class="input_btn_wrap">
                  <input class="s_input" type="text" name="">
                  <span class="btn_form"><a href="#">우편번호</a></span>
                  <input type="checkbox" id="basic_address_chk" name="basic_address_chk"><label for="basic_address_chk"><span></span>기본배송지로 선택</label>
                </div>
                <input type="text" name="">
              </td>
            </tr>
            <tr>
              <th>배송메모</th>
              <td><input type="text" name=""></td>
            </tr>
          </table>

          <h2 class="mt45">할인 및 포인트</h2>
          <table>
            <tr>
              <th>쿠폰</th>
              <td>
                <div class="input_btn_wrap">
                  <input class="s_input" type="text" name="">
                  <span class="btn_form"><a href="#">쿠폰사용</a></span>
                  <span class="fs_12">(사용가능 쿠폰: 4장)</span>
                </div>
              </td>
            </tr>
            <tr>
              <th>포인트</th>
              <td>
                <div class="input_btn_wrap">
                  <input class="s_input" type="text" name="">
                  <span class="btn_form"><a href="#">전액사용</a></span>
                  <span class="fs_12">(사용가능 포인트: <strong>2,723</strong>원)</span>
                </div>
              </td>
            </tr>
          </table>
        </div>
        <!-- delivery_info : e -->

        <!-- order_info : s -->
        <div class="order_info">
          <strong>주문자 정보</strong>
          <input type="text" name="" value="홍길동" placeholder="성함">
          <input type="text" name="" value="010-5246-8546" placeholder="연락처">
          <input type="text" name="" value="rocateer@rocateer.com" placeholder="이메일">

          <table>
            <tr>
              <th>총 상품금액</th>
              <td>202,400원</td>
            </tr>
            <tr>
              <th>배송비</th>
              <td>+ 2,500원</td>
            </tr>
            <tr>
              <th>할인금액</th>
              <td>-25,500원</td>
            </tr>
            <tr>
              <th>포인트</th>
              <td>0</td>
            </tr>
          </table>

          <div class="total_pay_price">
            <p>결제예정금액</p>
            <span><strong>91,000</strong>원</span>
          </div>
        </div>
        <!-- order_info : e -->

      </div>
      <!-- order_info_wrap : e -->

      <div class="btn_wrap">
        <span class="btn_m btn_basic"><a href="#">결제하기</a></span>
        <span class="btn_m btn_line"><a href="#">취소</a></span>
      </div>
    </div>

  </div>
</div>
