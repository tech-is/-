from time import sleep
from datetime import datetime
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import TimeoutException
from selenium.webdriver.common.action_chains import ActionChains
from selenium.webdriver.common.keys import Keys

form_list = {
    "text": {
        "customer_name": "田中太郎",
        "customer_kana": "タナカタロウ",
        "customer_mail": "aeample@example.com",
        "customer_tel": "08912223342",
        "customer_zip_adress": "7900931",
        "customer_address": "愛媛県松山市朝生田町6-4-2",
        "customer_add_info": "関西クレーマー",
        "pet_name": "ポチ",
        "pet_classification": "犬",
        "pet_type": "柴犬",
        "pet_body_height": "100",
        "pet_body_weight": "30",
        "pet_information": "かわいい"
    },
    "checkbox": {
        "customer_magazine": "",
    },
}

driver = webdriver.Chrome(executable_path="C:\Program Files (x86)\Google\Chrome\Application\chromedriver")
try:
    driver.get('http://animarl.com/cl_login/login')
    driver.find_element_by_name('email').send_keys("cipher_galm01@outlook.jp")
    driver.find_element_by_name('password').send_keys("cipher_galm01@outlook.jp")
    driver.find_element_by_id('submit').click()
    driver.get('http://animarl.com/cl_total_list/')
    # WebDriverWait(driver, 5).until(EC.presence_of_element_located((By.ID, 'register')))
    sleep(2)
    # WebDriverWait(driver, 10).until(EC.presence_of_element_located((By.ID, "register"))).click()
    driver.find_element_by_id('register').click()
    sleep(2)
    for key, lists in form_list.items():
        if key == "text":
            for name, value in lists.items():
                driver.find_element_by_name(name).send_keys(value)
        elif key == "checkbox":
            for name, value in lists.items():
                driver.find_element_by_class_name("switch").click()
    actions = ActionChains(driver)
    actions.send_keys(Keys.END)
    actions.perform()
    sleep(1)
    driver.find_element_by_id("send_register").click()
    sleep(3)
    driver.find_elements_by_class_name("swal-button swal-button--confirm").click()
except:
    import traceback
    traceback.print_exc()
    driver.save_screenshot(datetime.now().strftime("%Y-%m-%d_%H%M%S")+'.png')
    driver.quit()