# 超级管理员  
* level 1
* 有权访问包括公司（车队）列表内的所有列表

# 公司管理员
* level 2
* 有权访问除公司列表外的所有列表

# 司机
* level 3
* 只能访问自己所管理的汽车

# 数据表 
## users
## fleets
  * id 
  * fleet_name  车队名称  
  * user_id     管理员id
  * status      车队状态 0禁用 1空闲 2工作 

## drivers
  * id          
  * name        司机姓名
  * old         司机年龄
  * sex         司机性别
  * user_id     管理员id
  * fleet_id    所属车队id
  * status      司机状态 0禁用 1空闲 2工作

## cars
  * id 
  * fleet_name  车队名称
  * license_plate 牌照  
  * fleet_id     所属车队id
  * status      车队状态 0禁用 1空闲 2工作

# 注册
* 
### 注册用户 
   * 请求url
      * index.php/api/register_user
   * 需给参数
      * name
      * email
      * password
      * password_confirmation
      * pri\_level
      
                {
                  "email":"3222sc2@qq.com",
                  "name":"papzzzo",
                  "password":"123456789",
                  "password_confirmation":"123456789",
                  "pri_level":2
                }
   * 返回数据  
      json数据格式如下
     
            {
              "success": {
                "user": {
                  "name": "admin",
                  "email": "1026095482@qq.com",
                  "pri_level": "1",
                  "updated_at": "2019-03-23 05:25:23",
                  "created_at": "2019-03-23 05:25:23",
                  "id": 1
                }
              }
              "token" :{
              eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImI1MDM5MWU5MWU3NjdlNDdjNTA2MjZlNmQ4ZmE1M2NhMmViNzg1MDUyYzBmZGVjM2FmZTE1NjE1MThkNTA3ZmY5ZDRhYjc3ZjYwOGIwOTliIn0.eyJhdWQiOiIxIiwianRpIjoiYjUwMzkxZTkxZTc2N2U0N2M1MDYyNmU2ZDhmYTUzY2EyZWI3ODUwNTJjMGZkZWMzYWZlMTU2MTUxOGQ1MDdmZjlkNGFiNzdmNjA4YjA5OWIiLCJpYXQiOjE1NTMzMTk0MzksIm5iZiI6MTU1MzMxOTQzOSwiZXhwIjoxNTg0OTQxODM5LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.atQ-HsWZ3UfUzyumH3MycvZQsQ5gVQtrlASNOANGOaG_A56oXvR9cNCOBrDJ6AqsPBLkAvSU7RjhODwmsQfg2bTPdnfzqty7wYb8_Guor95OenqLGUhf0xJnpVfoxUu1fJlMSN9YSq0eREuyrUjPdh67gK79syvr_hlW4Spe77z-eljs4wm9cowmgwhjLjIQOWYvRYvBlLV57uijDj25HyjkuyTgJlyfjre0-PkUgHHesDpbt4kQuV4nQR2DiDJrp3nY4_CChWfkfpO7fPH19C-ATyMvuDA46k8VfqN8BE_O5hC9PLC3byMCwJ1bEgdIcMMyil7Z_SSQUNaCBCzPeoKBnBV8TyDiagZgMvE5QbHveBICwjj5hcgHxcYwJPVS-_2WWN-DSvjd5HuizL53d4WvDxItRgE9BO0cyxi_HFlijOLc-r9z8APbxTOkC8aK6aBL8b9ivCGzWp-ifDRYnyZFrlCh0pB9saH22dDC7zw-LW7Mu-WYh7ael3HvzJ1JzXhCevBmY7v0TUZhuy0KYRpsjHUAo4rxvu3I9ErwWxRKlMcRfpDddWmGzmIMrhPbAuvwORotxh6yDZDwSDs8jzudGnMP1ljCzhwBpDWuWhUhpvU_TH-NXgyFAUg7OdJcmnWaUjcTRQBLJo0VFvjUCeVIp3FbA2jEk1VvQrZgfUs
            }
            }
*  
### 注册角色  
   * 请求url
      * index.php/api/register_role
      * 并在请求时给header里增添如下
        Authorization:Bearer+空格+上面所给的token
   * 需给参数
      * 若注册为公司(车队)管理员  
          * fleet_name 
      * 若注册为普通司机
          - name
          - old
          - sex
          - fleet\_id
              - js异步请求index/api/info来加载车队名称和车队id 
                          
                        {
                          "driver_name":"采茶纪",
                          "old":23,
                          "sex":"男",
                          "fleet_id":2
                        }

# 登录  
   * 请求url
      * index.php/api/login
   * 需给参数
      * email
      * password
      * client_id
      * client\_secret  
         
            {
              "email":"1026095482@qq.com",
              "password":"123456789",
              "client_id":2,
              "client_secret":"LhSlAhFBSeNzdXqghSMDXKNE86OrbYPN56lszx2y"
            }
   * 返回数据  
      json数据如下

        {
          "token_type": "Bearer",
          "expires_in": 31622400,
          "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjE3YzJlYWEyOTMzMTJiYTRiZjljNjgxNDZlNGEwYmM4OTNiN2FkMTU0ZjRlYzdlOWVmNGY5MWZkOWU4YzFhOTJhNmFkOTJiZGFkZTkzY2NhIn0.eyJhdWQiOiIyIiwianRpIjoiMTdjMmVhYTI5MzMxMmJhNGJmOWM2ODE0NmU0YTBiYzg5M2I3YWQxNTRmNGVjN2U5ZWY0ZjkxZmQ5ZThjMWE5MmE2YWQ5MmJkYWRlOTNjY2EiLCJpYXQiOjE1NTMzMjE5MTAsIm5iZiI6MTU1MzMyMTkxMCwiZXhwIjoxNTg0OTQ0MzEwLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.cWuaz3sPXN7kTSQEe2Lp1f4g4CMAG7DZrFr6b62RKvMRXu0bFbf7bt9qKVaF2DekrWf9OgTknvVFmPXPHOi032St3rQC89MIe689v9UMXnWmxWvm58-KHNRvslY7E6j58Oe2E5-9qaklAYMEzGBkFF25cI3-bvR-Bd0ZxvEXlUBGPnzyoKfGj3wyoEIqKTaEYqoDpdJIvOV5MS4QhofWBq90An9WknwV7a9tylFYTXETXi9kqpH_RSFdWyOU3sBJNNvxeZCk0OROuZBcAawBU7EIIkAKSVmOH7VaquDIM0m3QoiZtaIaKdoMZx3SI94ltrYNBAdIOjvEcoDSyyqz-ZF6yCkc4FmcHCinwFcBlQLW_bgdanQMQHxIQRxXax0Ho5Fl5kI4qcz-kwQqvyWxzSDXELP_aPLqPdifwV4v0acHKF8NinsHzw0meBXK-QzVmWnRgyUzN-EqefkIvDakUdK8LJ2UJvrXzWiy4Nu5CvByVsmFJe63hkB_t3nQwCgY_0RLDa0F79Dods3H1n_hzRmJF9j_szD_VJM9WenQoFpIGx1p_6yvR6D77dKNjhUrBU14j5Qm1_HuQtKMSO3wsh964FX2nIMK4EMnoKOYSIXNZFVVU1xWgssG0eKqI8aFhPzid0VMuBUpR1W0GD5zUd6KVt-JSiWynYQGn20slmU",
          "refresh_token": "def502002a95587abdd22247b6ddbcce494c9e8e887c502aafdc37479e936e7e00c8a0fdc4b8c80a1fa402db2917a2c88cf4b791ca37b5be6f9ed60ede7ba808bede00823e140b6588d2c151c8ac25768de7ec55e59aad1eea4a7a37159bad6d4aa4fdc4e6f0e353f3cbd6097057d61a6861ad714622a30726314eb7f91ea6b602e8e331745cef6bd1c580e63a6a040bcc498a778e3bcdca1eaf3d029f46bd30947263e7384b6055d56ea38248dfba49a96dd3aa8a48d4e03210f077535dfecc2d6e0a52dbc2d899d282d1f18fccc4b44465ae8e69b1042641cf09e657b23eb94f39b62b28bf121c323cd9c66dcbe88d235100a412ca40d4317fc57b6f3f7ba7839f917a4d2fc86cedf0a0a00d9683906e872914683a24f2647d3046864989aeba3e2759ff1f1e58d542244bdd8c2c84a0a64e9acb6ca257e1a90b976e9a49deccc91aee3e7acc345788edf39845af14cd8fb26f6fff07364ef6e1b3044675143e"
        }

# 管理员  
* 
## 添加车队
   * 请求url
      * index.php/api/fleet/add
   * 需给参数  
       传递如下json格式数据  

                {
                  "fleet_name":"车队24"
                }

* 
## 展示车队
   * 请求url
      * index.php/api/fleet/show 
   * 返回数据  
      json数据如下
  
        [
          {
            "id": 1,
            "fleet_name": "车队4",
            "user_id": 5,
            "status": 1,
            "created_at": "2019-03-23 05:57:59",
            "updated_at": "2019-03-23 05:57:59"
          },
          {
            "id": 2,
            "fleet_name": "车队2",
            "user_id": 1,
            "status": 1,
            "created_at": null,
            "updated_at": null
          },
          {
            "id": 4,
            "fleet_name": "车队3",
            "user_id": 1,
            "status": 1,
            "created_at": null,
            "updated_at": null
          }
        ]

* 
## 删除车队  
  * 请求url  
      * index.php/api/fleet/delete
  * 需给参数  
     
            {
              "fleet_id":6
            }
  * 返回数据 

* 
## 修改车队  
  * 请求url  
      * index.php/api/fleet/update
  * 需给参数  
     
            {
              "fleet_id":5,
              "fleet_name":"蛇皮车队",
              "user_id":3,
              "status":2
            }
  * 返回数据 

# 公司管理员  
* 
## 添加司机
   * 请求url
      * index.php/api/driver/add
   * 需给参数  
       传递如下json格式数据  

            {
              "email":"32222@qq.com",
              "name":"papo",
              "password":"123456789",
              "driver_name":"栗子",
              "old":23,
              "sex":"男",
            }
        若为超级管理员添加司机，还要添加fleet_id字段为其指定车队
              如"fleet\_id":1

* 
## 展示司机
   * 请求url
      * index.php/api/driver/show 
   * 返回数据  
      json数据如下
  
            [
              {
                "id": 1,
                "name": "张三",
                "old": 22,
                "sex": "男",
                "status": 1,
                "user_id": 4,
                "fleet_id": 1,
                "created_at": "2019-03-23 06:02:40",
                "updated_at": "2019-03-23 06:02:40"
              },
              {
                "id": 2,
                "name": "王五",
                "old": 23,
                "sex": "男",
                "status": 1,
                "user_id": 6,
                "fleet_id": 1,
                "created_at": null,
                "updated_at": null
              },
              { 
                "id": 3,
                "name": "阿大葱",
                "old": 28,
                "sex": "男",
                "status": 2,
                "user_id": 8,
                "fleet_id": 1,
                "created_at": null,
                "updated_at": "2019-03-23 13:41:36"
              }
            ]

* 
## 删除司机  
  * 请求url  
      * index.php/api/driver/delete
  * 需给参数  
     
            {
              "fleet_id":1,
              "driver_id":3
            }
  * 返回数据 

* 
## 修改司机  
  * 请求url  
      * index.php/api/driver/update
  * 需给参数  
     
            {
              "driver_id":3,
              "driver_name":"阿大葱",
              "old":28,
              "sex":"男",
              "fleet_id":1,
              "status":2
            }
  * 返回数据 

# 普通用户  
* 
## 添加车辆
   * 请求url
      * index.php/api/car/add
   * 需给参数  
       传递如下json格式数据  
       司机：  

            {
              "license_plate":"粤E23424",
              "status":1
            }
        管理员：  

            {
              "license_plate":"粤E23424",
              "status":1,
              "driver_id":2
            }

* 
## 展示车辆
   * 请求url
      * index.php/api/car/show 
   * 返回数据  
      json数据如下
  
            [
              {
                "id": 1,
                "license_plate": "京E23424",
                "status": 1,
                "fleet_id": 1,
                "created_at": "2019-03-24 08:23:40",
                "updated_at": "2019-03-24 10:02:33",
                "pivot": {
                  "driver_id": 1,
                  "car_id": 1
                }
              },
              {
                "id": 3,
                "license_plate": "闽E23424",
                "status": 1,
                "fleet_id": 1,
                "created_at": "2019-03-24 09:59:05",
                "updated_at": "2019-03-24 09:59:05",
                "pivot": {
                  "driver_id": 1,
                  "car_id": 3
                }
            }

* 
## 删除车辆  
  * 请求url  
      * index.php/api/car/delete
  * 需给参数  
     
            {
              "car_id":2
            }
  * 返回数据 

* 
## 修改车辆  
  * 请求url  
      * index.php/api/car/update
  * 需给参数  
      普通司机  

            {
              "car_id":2,
              "license_plate":"粤E23424",
              "status":1
            }
      公司管理员   

            {
              "car_id":9,
              "driver_ids":[6,7],
              "license_plate":"沪B2399933",
              "status":1
            }
      超级管理员

            {
              "car_id":9,
              "fleet_id":1,
              "driver_ids":[6,7],
              "license_plate":"沪B2399933",
              "status":1
            }
  * 返回数据
