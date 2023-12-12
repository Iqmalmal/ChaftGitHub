@include('partials._tailwind')

<x-layout>
  <div class="bg-white flex flex-col items-center">
    <div
      class="bg-teal-200 bg-opacity-80 self-stretch flex w-full flex-col justify-center items-center px-16 py-11 max-md:max-w-full max-md:px-5"
    >
      <div class="w-[1259px] max-w-full mb-2">
        <div class="gap-5 flex max-md:flex-col max-md:items-stretch max-md:gap-0">
          <div
            class="flex flex-col items-stretch w-[29%] max-md:w-full max-md:ml-0"
          >
            <img
              loading="lazy"
              src="/images/logo.png"
              class="aspect-[0.76] object-contain object-center w-full overflow-hidden grow max-md:mt-10"
            />
          </div>
          <div
            class="flex flex-col items-stretch w-[71%] ml-5 max-md:w-full max-md:ml-0"
          >
            <div
              class="text-black text-6xl font-medium whitespace-nowrap my-auto max-md:max-w-full max-md:text-4xl max-md:mt-10"
            >
              <span class="font-medium">Fulfil Your Desire With</span>
              <span class="">Us.</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="w-full max-w-[1496px] mt-44 max-md:max-w-full max-md:mt-10">
      <div class="gap-5 flex max-md:flex-col max-md:items-stretch max-md:gap-0">
        <div
          class="flex flex-col items-stretch w-[65%] max-md:w-full max-md:ml-0"
        >
          <div
            class="flex flex-col items-stretch my-auto px-5 max-md:max-w-full max-md:mt-10"
          >
            <div
              class="text-black text-8xl whitespace-nowrap max-md:max-w-full max-md:text-4xl"
            >
              Chäft? What is it?
            </div>
            <div
              class="text-black text-justify text-4xl mt-14 max-md:max-w-full max-md:mt-10"
            >
              Chäft stands for business in Deutsch. Doesn’t mean we’re based in
              Germany, basically we’re based in
              <br />
              German- Malaysian Institute (GMI). Since we build an
              <br />
              E-Commerce website so Chäft is most suitable brand name for our
              website.
            </div>
          </div>
        </div>
        <div
          class="flex flex-col items-stretch w-[35%] ml-5 max-md:w-full max-md:ml-0"
        >
          <img
            loading="lazy"
            srcset="/images/logo.png"
            class="aspect-[0.84] object-contain object-center w-full overflow-hidden grow max-md:max-w-full max-md:mt-10"
          />
        </div>
      </div>
    </div>
    <div class="w-full max-w-[1796px] mt-60 max-md:max-w-full max-md:mt-10">
      <div class="gap-5 flex max-md:flex-col max-md:items-stretch max-md:gap-0">
        <div
          class="flex flex-col items-stretch w-[46%] max-md:w-full max-md:ml-0"
        >
          <img
            loading="lazy"
            srcset="/images/GMI.png"
            class="aspect-[1.76] object-contain object-center w-full overflow-hidden grow mt-11 max-md:max-w-full max-md:mt-10"
          />
        </div>
        <div
          class="flex flex-col items-stretch w-[54%] ml-5 max-md:w-full max-md:ml-0"
        >
          <div
            class="flex flex-col px-5 items-start max-md:max-w-full max-md:mt-10"
          >
            <div
              class="text-black text-8xl whitespace-nowrap ml-11 max-md:text-4xl max-md:ml-2.5"
            >
              About Us?
            </div>
            <div
              class="text-black text-justify text-4xl self-stretch mt-16 max-md:max-w-full max-md:mt-10"
            >
              GMI Chäft is a marketplace where our students may exchange goods on
              our website. We created this website in 2023 to assist our pupils in
              making money by signing up as merchants on our website.
              <br />
              <br />
              Additionally, by signing up as vendors, students who offer services
              like printing services and others may advertise them on our website.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layout>