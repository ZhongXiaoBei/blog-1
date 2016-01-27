# [第一篇](README.md)
# [Android Coding Standards](android/coding_standards.md)

# Android 四大组件
## Activity
### [onSaveInstanceState()方法分析](android/activity/onsaveinstancestate_method.md)
### [启动模式](android/activity/launch_mode.md)
### [startActivityForResult](android/start_activity_for_result.md)
### [ActivityGroup](android/activity_group.md)
### [Android 基础之开机自动运行](android/start_application_when_boot_completed.md)
### [是否需要给每个 Activity　类提供 startActivity　方法](android/start_activity_method_for_each_activity_class.md)

## Service
### [IntentService](android/service/intent_service.md)
### [IntentService 源码](android/service/intent_service_code.md)
### [startService 碰见 SecurityException](android/service/startservice_with_security_exception.md)
### [startService and bindService](android/service/startservice_and_bindservice.md)

## Broadcast Recevier
### [Android 广播](android/broadcast/android_broadcast.md)

## [Content Provider](android/provider/provider.md)

# Android

## [Intent](android/intent/summary.md)
### [Standard Activity Actions](android/intent/standard_activity_actions.md) 
### [Intent 的解析](android/intent/intent.md)
### [Android IntentFilter 匹配规则](android/intent_filter_rules.md)

## Fragment
### [FragmentTransaction add 和 replace 区别](android/fragment/fragmenttransaction_add_and_replace.md)
### [Android Fragment 和 FragmentManager 的代码分析](android/fragment/fragment_and_fragmentmanager_code.md)

## 进程和线程
### [Android 进程间通信](android/process_and_thread/android_interprocess_communications.md)
### [Linux 进程间通信](android/process_and_thread/linux_interprocess_communications.md)
### [进程与应用的生命周期](android/process_and_thread/processes_and_application_life_cycle.md)
### [Android Loader](android/thread_loader.md)

## 权限和安全机制
### [Permissions](android/permission/all_permissions.md)
### [Android 权限机制](android/permissions_system.md)
### [Android 开发安全机制](android/permissions_security_tips.md)
### [Permission Protection Level](android/permission_protection_level.md)

## 多媒体和资源
### [Android 多媒体 API](android/media/android_media_api.md)
### [MediaScannerConnection](android/media/media_scanner_connection.md)
### [res/xml res/raw 和 assets 以及其他资源文件的区别](android/resource/android_xml_raw_assets.md)
### [string.xml](android/resource/string_resources.md)
## UI Component
### [Toast](android/ui_component_toast.md)
### [SpannableString 与 SpannableStringBuilder](android/textview/spannablestring_and_spannablestringbuilder.md)
### [事件分发机制](android/touch/summary.md)
### [事件分发机制中的委托代理事件 TouchDelegate](android/touch/touch_delegate.md)
## [Android 数据存储方式](android/data_storage.md)
### [Android 的内部存储和外部存储](android/storage_internal_and_external.md)
### [获取外置 sdcard 和存储的空间大小](android/get_sdcard_and_innernal_storage_size.md)
## [调试工具](android/debug_tools/summary.md)
### [Hierarchy Viewer](android/debug_tools/hierarchy_viewer.md)
### [dmtracedump](android/debug_tools/dmtracedump.md)
### [Traceview](android/debug_tools/traceview.md)
## Android 网络
### [HttpClient](android/http_client.md)
### [HttpURLConnection](android/http_url_connection.md)
### [Android 移动网络类型](android/networks_type.md)
## [Android 虚拟机](android/vm_art.md)
## [消息推送](android/push_service.md)
## [adb](android/adb.md)
### [adb pm](android/android_adb_pm.md)

# [Android 动画](android/animation.md)
## [Android 动画之属性动画](android/animation_property.md)
## [Android 动画之视图动画](android/animation_view.md)
## [Android 动画之帧动画](android/animation_drawable.md)

# [Android 开发中遇到的坑](android/special_devices_bugs/summary.md)
## [Android 软键盘弹起和消失事件](android/special_devices_bugs/callback_of_soft_keyboard_show_hidden_events.md)
## [WebView 输入文本的时候，页面空白](android/special_devices_bugs/keyboard_hiding_edittext.md)
## [三星 4.3 系统数字选择器长按空指针](android/special_devices_bugs/npe_on_number_picker_form_long_press_on_samsung_devices.md)
## [contextImpl Failed to Ensure Directory](android/contextimpl_failed_to_ensure_directory.md)

# Java
## [注解 Annotation](java/java_annotation.md)
## [反射 Reflection](java/java_reflection.md)
## [基础数据类型](java/basic_data_type.md)
## [重载与重写](java/overloading_and_overriding.md)
## [克隆 Clone](java/clone.md)
## [字符串 String](java/string_summary.md)
## [Integer 的缓存](java/integer_cache.md)
## [异常](java/exception.md)
### [异常捕获](java/exception_catch.md)
### [异常抛出](java/exception_throw.md)
## [封装、继承与多态](java/basic_features.md)
# [设计模式与设计原则]
## [设计模式](pattern_and_principle/design_pattern/summary.md)
### [单例模式](pattern_and_principle/design_pattern/1_singleton_pattern.md)
### [简单工厂模式](pattern_and_principle/design_pattern/2_1_simple_factory_pattern.md)
### [工厂方法模式](pattern_and_principle/design_pattern/2_2_factory_method_pattern.md)
### [抽象工厂模式](pattern_and_principle/design_pattern/3_abstract_factory_pattern.md)
### [模板方法模式](pattern_and_principle/design_pattern/4_template_method_pattern.md)
### [建造者模式](pattern_and_principle/design_pattern/5_builder_pattern.md)
### [代理模式](pattern_and_principle/design_pattern/6_proxy_pattern.md)
### [原型模式](pattern_and_principle/design_pattern/7_prototype_pattern.md)
### [组合模式](pattern_and_principle/design_pattern/8_composite_pattern.md)
### [享元模式](pattern_and_principle/design_pattern/9_flyweight_pattern.md)
##  [设计原则](pattern_and_principle/design_principle/summary.md)
### [单一职责原则](pattern_and_principle/design_principle/1_single_responsibility_principle.md)
### [里氏替换原则](pattern_and_principle/design_principle/2_liskov_substitution_principle.md)
### [迪米特法则](pattern_and_principle/design_principle/3_law_of_demeter.md)
### [开闭原则](pattern_and_principle/design_principle/4_open_closed_principle.md)
### [接口隔离原则](pattern_and_principle/design_principle/5_interface_segregation_principle.md)
### [依赖倒置原则](pattern_and_principle/design_principle/6_dependence_inversion_principle.md)
# [版本控制](version_controll/summary.md)
##  [git diff](version_controll/git_diff.md)
# Linux
## [dnsmasq](linux/dnsmasq.md)
## [netstat](linux/netstat.md)
## [Ubuntu iotop](linux/iotop.md)
## [Ubuntu & Debian RAM Disk](linux/ubuntu_and_debian_ram_disk.md)
# 计算机
## [计算机安全](computer/computer_security/computer_security_encryption.md)
## [RESTful API](computer/restful_api.md)
# 计算机网络
## IP 协议
## [HTTP 协议](computer/http.md)
## [TCP 协议](computer/networks_tcp.md)
## UDP 协议
## DNS 服务
## DHCP 服务
## [mDNS](computer/mdns.md)
# 感悟
## [一个渠道号获取方法的优化](others/expression_a_channel_name_bug.md)
## [InputStream read() 的封装](others/expression_io_readlong.md)
# 其他
## [软件和工具](others/software_and_tools.md)
## [网络常用配置](linux/networks_config.md)
	

