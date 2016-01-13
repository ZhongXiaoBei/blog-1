# Android IntentFilter 匹配规则

每个 Android 的组件都需要给自己设定一个 IntentFilter 来向系统注册自己对什么样的 Intent 感兴趣。当一个组件发出一个 隐式Intent 的时候，系统需要为这个 Intent 找到接收者，于是就会在各个组件注册的 IntentFilter 里去查找。
在一个 IntentFilter 判断是否匹配某一个 Intent 的时候, 有三个条件必须符合： 动作（action），分类（category） , 数据（data）。如果特别指定的话，数据包括数据类型（data type）和数据（data scheme+authority+path）。IntentFilter.match(ContentResolver, Intent, boolean, String)有更多数据匹配的细节。

<!--more-->

 - **Action** matches if any of the given values match the Intent action; if the filter specifies no actions, then it will only match Intents that do not contain an action.

 - **Data Type** matches if any of the given values match the Intent type. The Intent type is determined by calling resolveType(ContentResolver). A wildcard can be used for the MIME sub-type, in both the Intent and IntentFilter, so that the type "audio/*" will match "audio/mpeg", "audio/aiff", "audio/*", etc. Note that MIME type matching here is case sensitive, unlike formal RFC MIME types! You should thus always use lower case letters for your MIME types.

 - **Data Scheme** matches if any of the given values match the Intent data's scheme. The Intent scheme is determined by calling getData() and getScheme() on that URI. Note that scheme matching here is case sensitive, unlike formal RFC schemes! You should thus always use lower case letters for your schemes.

 - **Data Scheme Specific Part** matches if any of the given values match the Intent's data scheme specific part and one of the data schemes in the filter has matched the Intent, or no scheme specific parts were supplied in the filter. The Intent scheme specific part is determined by calling getData() and getSchemeSpecificPart() on that URI. Note that scheme specific part matching is case sensitive.

 - **Data Authority** matches if any of the given values match the Intent's data authority and one of the data schemes in the filter has matched the Intent, or no authories were supplied in the filter. The Intent authority is determined by calling getData() and getAuthority() on that URI. Note that authority matching here is case sensitive, unlike formal RFC host names! You should thus always use lower case letters for your authority.

 - **Data Path** matches if any of the given values match the Intent's data path and both a scheme and authority in the filter has matched against the Intent, or no paths were supplied in the filter. The Intent authority is determined by calling getData() and getPath() on that URI.

 - **Categories** match if all of the categories in the Intent match categories given in the filter. Extra categories in the filter that are not in the Intent will not cause the match to fail. Note that unlike the action, an IntentFilter with no categories will only match an Intent that does not have any categories.